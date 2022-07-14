<?php
namespace Mint\Http;

defined('MINT') || die;

use Mint\Traits\MessageHttp;

/**
 * 
 * @package Http
 */
class Request
{
    public $method;
    public $request_target;

    use MessageHttp;

    public function __construct()
    {
        $this->setMethod($_SERVER['REQUEST_METHOD']);
        $this->setRequestTarget($_SERVER['REQUEST_URI']);
        $this->setProtocolVersion(substr($_SERVER['SERVER_PROTOCOL'], strrpos($_SERVER['SERVER_PROTOCOL'], '/') + 1));

        foreach ($_SERVER as $name => $value) {
            if (preg_match('/^HTTP_/', $name)) {
                $this->setHeader($name, $value);
            }
        }
    }

    /** 
     * Recupera el destino de la solicitud del mensaje. 
     * 
     * Recupera el destino de la solicitud del mensaje tal como aparecerá (por 
     *clientes), tal como aparecía a pedido (para servidores), o tal como era 
     * especificado para la instancia (ver withRequestTarget()). 
     * 
     * En la mayoría de los casos, esta será la forma de origen del URI compuesto, 
     * a menos que se haya proporcionado un valor a la implementación concreta (ver 
     * withRequestTarget() a continuación). 
     * 
     * Si no hay un URI disponible y no se ha especificado ningún objetivo de solicitud 
     * proporcionado, este método DEBE devolver la cadena "/". 
     * 
     * @return string
     */
    public function getRequestTarget()
    {
        return isset($this->request_target) ? $this->request_target : '/';
    }

    /** 
     * Devuelve una instancia con el objetivo de solicitud específico. 
     * 
     * Si la solicitud necesita un destino de solicitud que no sea de origen, por ejemplo, para 
     * especificando una forma absoluta, forma de autoridad o forma de asterisco — 
     * este método se puede utilizar para crear una instancia con el especificado 
     * solicitud-objetivo, palabra por palabra. 
     * 
     * Este método DEBE implementarse de tal manera que conserve la 
     * inmutabilidad del mensaje, y DEBE devolver una instancia que tenga el 
     * cambió el objetivo de la solicitud. 
     * 
     * @link http://tools.ietf.org/html/rfc7230#section-5.3 (para los diversos 
     * formularios de destino de solicitud permitidos en mensajes de solicitud) 
     * @param mixto $requestTarget 
     * @return estático 
     */
    public function setRequestTarget($requestTarget = null): self
    {
        $this->request_target = $requestTarget;

        return $this;
    }

    /** 
     * Recupera el método HTTP de la solicitud. 
     * 
     * @return string Devuelve el método de solicitud. 
     */
    public function getMethod()
    {
        return $this->method;
    }

    /** 
     * Devolver una instancia con el método HTTP proporcionado. 
     * 
     * Si bien los nombres de los métodos HTTP suelen estar todos en mayúsculas, HTTP 
     * los nombres de los métodos distinguen entre mayúsculas y minúsculas y, por lo tanto, las implementaciones NO DEBEN 
     * modificar la cadena dada. 
     * 
     * Este método DEBE implementarse de tal manera que conserve la 
     * inmutabilidad del mensaje, y DEBE devolver una instancia que tenga el 
     * método de solicitud cambiado. 
     * 
     * @param string $método Método que distingue entre mayúsculas y minúsculas. 
     * @return estático 
     * @throws \InvalidArgumentException para métodos HTTP no válidos. 
     */
    public function setMethod(String $method): self
    {
        $this->method = strtoupper($method);
        return $this;
    }

    /** 
     * Recupera la instancia de URI. 
     * 
     * Este método DEBE devolver una instancia de Uri. 
     * 
     * @link http://tools.ietf.org/html/rfc3986#section-4.3 
     * @return Uri Vuelve a la instancia de Uri 
     * que representa el URI de la solicitud. 
     */
    public function getUri(): Uri
    {
        return new Uri($_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI']);
    }
}