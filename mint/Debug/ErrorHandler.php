<?php

defined('MINT') || die;
namespace Mint\Debug;

use ErrorException;
use Mint\Http\Response;
use Throwable;

/**
 * undocumented class
 */
class ErrorHandler
{
    protected $env;

    protected $templ = true;

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function __construct(Bool $env = false)
    {
        $this->ob_level = ob_get_level();
        $this->env = $env;

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function start()
    {
        set_exception_handler([$this, 'exceptionHandler']);
        set_error_handler([$this, 'errorHandler']);
        register_shutdown_function([$this, 'shutdownHandler']);
    }

    /**
     * Manejador de excepciones
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function exceptionHandler(Throwable $exception)
    {
        // Log 
        //$this->logs();

        $this->render($exception);
    }

    /**
     * Manejador de errores
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function errorHandler(int $severity, string $message, string $file = null, int $line = null)
    {
        if (!(error_reporting() & $severity)) {
            return;
        }

        throw new ErrorException($message, 0, $severity, $file, $line);
    }

    /**
     * Manejador de cierre
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function shutdownHandler()
    {
        $error = error_get_last();

        if (!is_null($error)) {
            // Fatal Error?
            if (in_array($error['type'], [E_ERROR, E_CORE_ERROR, E_COMPILE_ERROR, E_PARSE], true)) {
                $this->exceptionHandler(new ErrorException($error['message'], 0, $error['type'], $error['file'], $error['line']));
            }
        }
    }

    /**
     * Renderizado
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    protected function render(Throwable $e)
    {
        // Determine the views
        $view = $this->determineView($e->getCode());

        //implementar plantillas para los temas
        /*if (! isset($view)) {
            echo 'The error view files were not found. Cannot render exception trace.';
            exit(1);
        }*/

        if (ob_get_level() > $this->ob_level + 1) {
            ob_clean();
        }

        //llamar a la vista del errorhandler
        /*echo(function () use ($e,$view): string {
            $vars = $this->collectVars($e);
            extract($vars);

            ob_start();
            include FP_PATH."admin/$view.php";
            return ob_get_clean();
        })();*/

        $headers = [];
        $e->getCode() != 404 ? new Response(500, $headers) : new Response(404, $headers);
        if (ob_get_length()) ob_end_clean();
        extract($this->collectVars($e));
        //include FP_PATH . "admin/$view.php";
        require _THEMES . "errors/$view";
        ob_flush();
        return ob_end_clean();
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return array
     * @throws conditon
     **/
    protected function collectVars(Throwable $e): array
    {
        $data = [
            'title'   => get_class($e),
            'code'    => $e->getCode(),
            'message' => $e->getMessage() ?? '(null)',
            'file'    => $e->getFile(),
            'line'    => $e->getLine(),
            'traces'   => $e->getTrace(),
            //'s_trace'   => $e->getTraceAsString(),
        ];

        if ($e instanceof ErrorException) {
            switch ($e->getSeverity()) {
                case E_ERROR: // 1
                    $data['type'] = 'E_ERROR';
                    break;
                case E_WARNING: // 2
                    $data['type'] = 'E_WARNING';
                    break;
                case E_PARSE: // 4
                    $data['type'] = 'E_PARSE';
                    break;
                case E_NOTICE: // 8
                    $data['type'] = 'E_NOTICE';
                    break;
                case E_CORE_ERROR: // 16
                    $data['type'] = 'E_CORE_ERROR';
                    break;
                case E_CORE_WARNING: // 32
                    $data['type'] = 'E_CORE_WARNING';
                    break;
                case E_COMPILE_ERROR: // 64
                    $data['type'] = 'E_COMPILE_ERROR';
                    break;
                case E_COMPILE_WARNING: // 128
                    $data['type'] = 'E_COMPILE_WARNING';
                    break;
                case E_USER_ERROR: // 256
                    $data['type'] = 'E_USER_ERROR';
                case E_USER_WARNING: // 512
                    $data['type'] = 'E_USER_WARNING';
                    break;
                case E_USER_NOTICE: // 1024
                    $data['type'] = 'E_USER_NOTICE';
                    break;
                case E_STRICT: // 2048
                    $data['type'] = 'E_STRICT';
                    break;
                case E_RECOVERABLE_ERROR: // 4096
                    $data['type'] = 'E_RECOVERABLE_ERROR';
                    break;
                case E_DEPRECATED: // 8192
                    $data['type'] = 'E_DEPRECATED';
                    break;
                case E_USER_DEPRECATED: // 16384
                    $data['type'] = 'E_USER_DEPRECATED';
                    break;
            }
        } else {
            $data['type'] = get_class($e);
        }

        return $data;
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    protected function determineView(Int $code)
    {
        // Error 404
        if ($code == 404) return '404.php';

        return ($this->env) ? 'debug.php' : 'error.php';
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    protected function logs()
    {
        // implementar para q no registre los errores 404
        if (env('logs')/* && !in_array($statusCode, $this->config->ignoreCodes, true)*/) {
            //implementar logs function
            /*log_message('critical', $exception->getMessage() . "\n{trace}", [
                'trace' => $exception->getTraceAsString(),
            ]);*/
        }
    }
}
