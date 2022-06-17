<?php

namespace Mint\Traits;

defined('MINT') || die;
/** 
 * Los mensajes HTTP consisten en solicitudes de un cliente a un servidor y respuestas 
 * de un servidor a un cliente.  Esta interfaz define los métodos comunes a 
 * cada. 
 * 
 * Los mensajes se consideran inmutables;  todos los métodos que pueden cambiar de estado DEBEN 
 * implementarse de manera que conserven el estado interno de los actuales 
 * mensaje y devolver una instancia que contiene el estado modificado. 
 * 
 * @enlace http://www.ietf.org/rfc/rfc7230.txt 
 * @enlace http://www.ietf.org/rfc/rfc7231.txt 
 */

trait MessageHttp
{
    public $protocol = '1.1';
    public $headers = [];

    /** 
     * Recupera la versión del protocolo HTTP como una cadena. 
     * 
     * La cadena DEBE contener solo el número de versión HTTP (p. ej., "1.1", "1.0"). 
     * 
     * @return string Versión del protocolo HTTP. 
     */
    public  function  getProtocolVersion()
    {
        return $this->protocol;
    }

    /** 
     * Devuelve una instancia con la versión de protocolo HTTP especificada. 
     * 
     * La cadena de versión DEBE contener solo el número de versión HTTP (p. ej., 
     * "1.1", "1.0"). 
     * 
     * Este método DEBE implementarse de tal manera que conserve la 
     * inmutabilidad del mensaje, y DEBE devolver una instancia que tenga el 
     * nueva versión del protocolo. 
     * 
     * @param string $version Versión del protocolo HTTP 
     * @return static 
     */
    public function setProtocolVersion($version)
    {
        $this->protocol = $version;
        return $this;
    }

    /** 
     * Recupera todos los valores de encabezado de mensaje. 
     * 
     * Las teclas representan el nombre del encabezado tal como se enviará por cable, y 
     * cada valor es una matriz de cadenas asociadas con el encabezado. 
     * 
     * // Representa los encabezados como una cadena 
     * foreach ($mensaje->getHeaders() as $nombre => $valores) { 
     * echo $nombre.  ": " .  implosión(", ", $valores); 
     *     } 
     * 
     * // Emite encabezados iterativamente: 
     * foreach ($mensaje->getHeaders() as $nombre => $valores) { 
     * foreach ($valores como $valor) { 
     * header(sprintf('%s: %s', $nombre, $valor), false); 
     *         } 
     *     } 
     * 
     * Si bien los nombres de los encabezados no distinguen entre mayúsculas y minúsculas, getHeaders() conservará el 
     * caso exacto en el que se especificaron originalmente los encabezados. 
     * 
     * @return string[][] Devuelve una matriz asociativa de los encabezados del mensaje.  Cada 
     * la clave DEBE ser un nombre de encabezado, y cada valor DEBE ser una matriz de cadenas 
     * para ese encabezado. 
     */
    public  function  getHeaders()
    {
        return $this->headers;
    }

    /** 
     * Comprueba si existe un encabezado por el nombre dado que no distingue entre mayúsculas y minúsculas. 
     * 
     * @param string $name Nombre de campo de encabezado que no distingue entre mayúsculas y minúsculas. 
     * @return bool Devuelve verdadero si algún nombre de encabezado coincide con el encabezado dado 
     * nombre utilizando una comparación de cadenas que no distingue entre mayúsculas y minúsculas.  Devuelve falso si 
     * no se encuentra ningún nombre de encabezado coincidente en el mensaje. 
     */
    public function hasHeader($name)
    {
        return key_exists($name, $this->getHeaders()) ? true : false;
    }

    /** 
     * Recupera un valor de encabezado de mensaje por el nombre dado que no distingue entre mayúsculas y minúsculas. 
     * 
     * Este método devuelve una matriz de todos los valores de encabezado de la dada 
     * nombre de encabezado que no distingue entre mayúsculas y minúsculas. 
     * 
     * Si el encabezado no aparece en el mensaje, este método DEBE devolver un 
     * matriz vacía. 
     * 
     * @param string $name Nombre de campo de encabezado que no distingue entre mayúsculas y minúsculas. 
     * @return string[] Una matriz de valores de cadena como se proporciona para el 
     * encabezado.  Si el encabezado no aparece en el mensaje, este método DEBE 
     * devuelve una matriz vacía. 
     */
    public function getHeader($name)
    {
        $key = $this->sanitizeHeader($name);
        return (key_exists($key, $this->getHeaders())) ? $this->getHeaders()[$key] : [];
    }

    /** 
     * Devuelve una instancia con el valor proporcionado reemplazando el encabezado especificado. 
     * 
     * Si bien los nombres de los encabezados no distinguen entre mayúsculas y minúsculas, las mayúsculas y minúsculas del encabezado 
     * ser conservado por esta función y devuelto por getHeaders(). 
     * 
     * Este método DEBE implementarse de tal manera que conserve la 
     * inmutabilidad del mensaje, y DEBE devolver una instancia que tenga el 
     * encabezado y valor nuevos y/o actualizados. 
     * 
     * @param string $name Nombre de campo de encabezado que no distingue entre mayúsculas y minúsculas. 
     * @param string|string[] $valor Valor(es) de encabezado. 
     * @return static 
     * @throws \InvalidArgumentException para nombres o valores de encabezado no válidos. 
     */
    public function setHeader($name, $value)
    {
        $this->headers[$this->sanitizeHeader($name)] = $value;
        return $this;
    }

    /** 
     * Devuelve una instancia con el encabezado especificado adjunto con el valor dado. 
     * 
     * Se mantendrán los valores existentes para el encabezado especificado.  El nuevo 
     * los valores se agregarán a la lista existente.  Si el encabezado no 
     * existe previamente, se agregará. 
     * 
     * Este método DEBE implementarse de tal manera que conserve la 
     * inmutabilidad del mensaje, y DEBE devolver una instancia que tenga el 
     * nuevo encabezado y/o valor. 
     * 
     * @param string $name Nombre de campo de encabezado que no distingue entre mayúsculas y minúsculas para agregar. 
     * @param string|string[] $valor Valor(es) de encabezado. 
     * @return static 
     * @throws \InvalidArgumentException para nombres o valores de encabezado no válidos. 
     */
    public function addHeader($name, $value)
    {
        $key = $this->sanitizeHeader($name);
        if (key_exists($key, $this->getHeader($name))) {
            array_push($this->getHeader($name), $value);
        } else {
            $this->getHeaders()[$key] = $value;
        }

        return $this;
    }

    /** 
     * Devuelve una instancia sin el encabezado especificado. 
     * 
     * La resolución del encabezado DEBE realizarse sin distinción entre mayúsculas y minúsculas. 
     * 
     * Este método DEBE implementarse de tal manera que conserve la 
     * inmutabilidad del mensaje, y DEBE devolver una instancia que elimine 
     * el encabezado nombrado. 
     * 
     * @param string $name Nombre de campo de encabezado que no distingue entre mayúsculas y minúsculas para eliminar. 
     * @return static 
     */
    public function removeHeader($name)
    {
        unset($this->getHeaders()[$name]);
        return $this;
    }

    /** 
     * Obtiene el cuerpo del mensaje. 
     * 
     * @return StreamInterface Devuelve el cuerpo como una secuencia. 
     */
    public  function getBody()
    {
    }

    public function sanitizeHeader(string $name)
    {
        return str_replace(' ', '-', ucwords(str_replace(['-', '_'], ' ', $name)));
    }
}
