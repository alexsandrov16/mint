<?php
defined('MINT') || die;

namespace Mint\Http;

/**
 * undocumented class
 */
class Uri
{
    protected $scheme;
    protected $host;
    protected $port = NULL;
    protected $path;
    protected $query;
    protected $fragment;

    protected $standar_ports = [
        'http'  => 80,
        'https' => 443,
    ];

    public function __construct(string $uri = NULL)
    {
        if (!is_null($uri)) {
            $parts = parse_url($uri);
            if ($parts === false) {
                //throw new \InvalidArgumentException("Unable to parse URI: {$uri}");
                //throw HTTPException::forUnableToParseURI($uri)
                die('error');
            }
            $this->setUri($parts);
        }
    }

    public function setUri(array $parts)
    {
        $scheme   = isset($parts['scheme'])   ? $parts['scheme'] :   NULL;
        $host     = isset($parts['host'])     ? $parts['host'] :     NULL;
        $port     = isset($parts['port'])     ? $parts['port'] :     NULL;
        $path     = isset($parts['path'])     ? $parts['path'] :     NULL;
        $query    = isset($parts['query'])    ? $parts['query'] :    NULL;
        $fragment = isset($parts['fragment']) ? $parts['fragment'] : NULL;

        return $this->setScheme($scheme)
            ->setHost($host)
            ->setPort($port)
            ->setPath($path)
            ->setQuery($query)
            ->setFragment($fragment);
    }

    /** 
     * Devuelve una instancia con el esquema especificado. 
     * 
     * Este método DEBE conservar el estado de la instancia actual y devolver 
     * una instancia que contiene el esquema especificado. 
     * 
     * Las implementaciones DEBEN admitir los esquemas "http" y "https" 
     * insensiblemente, y PUEDE acomodar otros esquemas si es necesario. 
     * 
     * Un esquema vacío es equivalente a eliminar el esquema. 
     * 
     * @param string $scheme El esquema a utilizar con la nueva instancia. 
     * @return static Una nueva instancia con el esquema especificado. 
     * @throws \InvalidArgumentException para esquemas no válidos o no admitidos. 
     */
    public function setScheme($scheme)
    {
        $this->scheme = $scheme;
        return $this;
    }

    /** 
     * Devolver una instancia con la información de usuario especificada. 
     * 
     * Este método DEBE conservar el estado de la instancia actual y devolver 
     * una instancia que contiene la información de usuario especificada. 
     * 
     * La contraseña es opcional, pero la información del usuario DEBE incluir el 
     * usuario;  una cadena vacía para el usuario es equivalente a eliminar al usuario 
     * información. 
     * 
     * @param cadena $usuario El nombre de usuario que se usará para la autorización. 
     * @param null|string $contraseña La contraseña asociada con $usuario. 
     * @return static Una nueva instancia con la información de usuario especificada. 
     */
    public function setUserInfo($user, $password = null)
    {
    }

    /** 
     * Devuelve una instancia con el host especificado. 
     * 
     * Este método DEBE conservar el estado de la instancia actual y devolver 
     * una instancia que contiene el host especificado. 
     * 
     * Un valor de host vacío equivale a eliminar el host. 
     * 
     * @param string $host El nombre de host que se usará con la nueva instancia. 
     * @return static Una nueva instancia con el host especificado. 
     * @throws \InvalidArgumentException para nombres de host no válidos. 
     */
    public function setHost($host)
    {
        if (isset($host)) {
            $this->host = $host;
        } else {
            $this->host = '';
        }
        return $this;
    }

    /** 
     * Devolver una instancia con el puerto especificado. 
     * 
     * Este método DEBE conservar el estado de la instancia actual y devolver 
     * una instancia que contiene el puerto especificado. 
     * 
     * Las implementaciones DEBEN generar una excepción para los puertos fuera del 
     * Rangos de puertos TCP y UDP establecidos. 
     * 
     * Un valor nulo proporcionado para el puerto es equivalente a eliminar el puerto 
     * información. 
     * 
     * @param null|int $port El puerto a usar con la nueva instancia;  un valor nulo 
     * elimina la información del puerto. 
     * @return static Una nueva instancia con el puerto especificado. 
     * @throws \InvalidArgumentException para puertos no válidos. 
     */
    public function setPort($port)
    {
        try {
            if (is_null($port)) {
                return $this;
            }

            if ($port > 0 || $port < 65535) {
                $this->port = (int) $port;
                return $this;
            } else {
                throw new \InvalidArgumentException("Error Processing Port", 1);
            }
        } catch (\InvalidArgumentException $th) {
            die($th->getMessage());
        }
    }

    /** 
     * Devuelve una instancia con la ruta especificada. 
     * 
     * Este método DEBE conservar el estado de la instancia actual y devolver 
     * una instancia que contiene la ruta especificada. 
     * 
     * La ruta puede estar vacía o absoluta (comenzando con una barra oblicua) o 
     * sin raíz (sin comenzar con una barra inclinada).  Las implementaciones DEBEN soportar todos 
     * tres sintaxis. 
     * 
     * Si la ruta está destinada a ser relativa al dominio en lugar de relativa a la ruta, entonces 
     * debe comenzar con una barra inclinada ("/").  Rutas que no comienzan con una barra inclinada ("/") 
     * se supone que son relativos a alguna ruta base conocida por la aplicación o 
     * consumidor. 
     * 
     * Los usuarios pueden proporcionar caracteres de ruta codificados y decodificados. 
     * Las implementaciones aseguran la codificación correcta como se describe en getPath(). 
     * 
     * @param string $ruta La ruta a usar con la nueva instancia. 
     * @return static Una nueva instancia con la ruta especificada. 
     * @throws \InvalidArgumentException para rutas no válidas. 
     */
    public function setPath($path)
    {
        if (isset($path)) {
            $this->path = strtok($path, '?');
        } else {
            $this->path = '/';
        }

        return $this;
    }
    /** 
     * Devolver una instancia con la cadena de consulta especificada. 
     * 
     * Este método DEBE conservar el estado de la instancia actual y devolver 
     * una instancia que contiene la cadena de consulta especificada. 
     * 
     * Los usuarios pueden proporcionar caracteres de consulta codificados y decodificados. 
     * Las implementaciones aseguran la codificación correcta como se describe en getQuery(). 
     * 
     * Un valor de cadena de consulta vacío es equivalente a eliminar la cadena de consulta. 
     * 
     * @param string $query La cadena de consulta que se usará con la nueva instancia. 
     * @return static Una nueva instancia con la cadena de consulta especificada. 
     * @throws \InvalidArgumentException para cadenas de consulta no válidas. 
     */
    public function setQuery($query)
    {
        return $this;
    }

    /** 
     * Devuelve una instancia con el fragmento de URI especificado. 
     * 
     * Este método DEBE conservar el estado de la instancia actual y devolver 
     * una instancia que contiene el fragmento de URI especificado. 
     * 
     * Los usuarios pueden proporcionar caracteres de fragmentos codificados y decodificados. 
     * Las implementaciones aseguran la codificación correcta como se describe en getFragment(). 
     * 
     * Un valor de fragmento vacío es equivalente a eliminar el fragmento. 
     * 
     * @param string $fragment El fragmento que se usará con la nueva instancia. 
     * @return static Una nueva instancia con el fragmento especificado. 
     */
    public function setFragment($fragment)
    {
        return $this;
    }

    /** 
     * Recuperar el componente de esquema de la URI. 
     * 
     * Si no hay un esquema presente, este método DEBE devolver una cadena vacía. 
     * 
     * El valor devuelto DEBE normalizarse a minúsculas, según RFC 3986 
     * Apartado 3.1. 
     * 
     * El carácter final ":" no forma parte del esquema y NO DEBE 
     * agregado. 
     * 
     * @see https://tools.ietf.org/html/rfc3986#section-3.1 
     * @return string El esquema URI. 
     */
    public  function  getScheme()
    {
        return $this->scheme;
    }

    /** 
     * Recuperar el componente de autoridad de la URI. 
     * 
     * Si no hay información de autoridad presente, este método DEBE devolver un vacío 
     * cuerda. 
     * 
     * La sintaxis de autoridad de la URI es: 
     * 
     * <antes> 
     * [información-usuario@]host[:puerto] 
     * </pre> 
     * 
     * Si el componente del puerto no está configurado o es el puerto estándar para el puerto actual 
     * esquema, NO DEBE incluirse. 
     * 
     * @see https://tools.ietf.org/html/rfc3986#section-3.2 
     * @return string La autoridad URI, en formato "[user-info@]host[:port]". 
     */
    public  function  getAuthority()
    {
        if (empty($this->host)) {
            return '';
        }

        $authority = !empty($this->getPort()) ? $this->host . ':' . $this->getPort() : "$this->host";

        return $authority;
    }

    /** 
     * Recuperar el componente de información de usuario de la URI. 
     * 
     * Si no hay información de usuario presente, este método DEBE devolver un vacío 
     * cuerda. 
     * 
     * Si un usuario está presente en la URI, este devolverá ese valor; 
     * además, si la contraseña también está presente, se agregará a la 
     * valor de usuario, con dos puntos (":") separando los valores. 
     * 
     * El carácter "@" final no forma parte de la información del usuario y DEBE 
     * NO se agregará. 
     * 
     * @return string La información de usuario URI, en formato "nombre de usuario [: contraseña]". 
     */
    public  function  getUserInfo()
    {
    }

    /** 
     * Recuperar el componente host del URI. 
     * 
     * Si no hay host presente, este método DEBE devolver una cadena vacía. 
     * 
     * El valor devuelto DEBE normalizarse a minúsculas, según RFC 3986 
     * Apartado 3.2.2. 
     * 
     * @see http://tools.ietf.org/html/rfc3986#section-3.2.2 
     * @return string El host URI. 
     */
    public function getHost()
    {
        return $this->host;
    }


    /** 
     * Recuperar el componente de puerto de la URI. 
     * 
     * Si hay un puerto presente y no es estándar para el esquema actual, 
     * este método DEBE devolverlo como un número entero.  Si el puerto es el puerto estándar 
     * utilizado con el esquema actual, este método DEBERÍA devolver nulo. 
     * 
     * Si no hay ningún puerto y ningún esquema, este método DEBE devolver 
     * un valor nulo. 
     * 
     * Si no hay ningún puerto presente, pero sí un esquema, este método PUEDE devolver 
     * el puerto estándar para ese esquema, pero DEBERÍA devolver nulo. 
     * 
     * @return null|int El puerto URI. 
     */
    public  function  getPort()
    {

        if ($this->getScheme() == '') {
            return null;
        }
        foreach ($this->standar_ports as $key => $value) {
            if ($key === $this->getScheme() && $value === $this->port) {
                return null;
            }
        }
        return $this->port;
    }

    /** 
     * Recuperar el componente de ruta del URI. 
     * 
     * La ruta puede estar vacía o absoluta (comenzando con una barra oblicua) o 
     * sin raíz (sin comenzar con una barra inclinada).  Las implementaciones DEBEN soportar todos 
     * tres sintaxis. 
     * 
     * Normalmente, la ruta vacía "" y la ruta absoluta "/" se consideran iguales a 
     * definido en RFC 7230 Sección 2.7.3.  Pero este método NO DEBE automáticamente 
     * hacer esta normalización porque en contextos con una ruta base recortada, por ejemplo 
     * el controlador frontal, esta diferencia se vuelve significativa.  es la tarea 
     * del usuario para manejar tanto "" como "/". 
     * 
     * El valor devuelto DEBE estar codificado en porcentaje, pero NO DEBE codificarse dos veces 
     * cualquier carácter.  Para determinar qué caracteres codificar, consulte 
     * RFC 3986, Secciones 2 y 3.3. 
     * 
     * Como ejemplo, si el valor debe incluir una barra inclinada ("/") que no pretende ser 
     * delimitador entre segmentos de ruta, ese valor DEBE pasarse codificado 
     * formulario (p. ej., "%2F") a la instancia. 
     * 
     * @see https://tools.ietf.org/html/rfc3986#section-2 
     * @see https://tools.ietf.org/html/rfc3986#section-3.3 
     * @return string La ruta URI. 
     */
    public  function  getPath()
    {
        return $this->path;
    }

    /** 
     * Recuperar la cadena de consulta de la URI. 
     * 
     * Si no hay una cadena de consulta presente, este método DEBE devolver una cadena vacía. 
     * 
     * El líder "?"  carácter no es parte de la consulta y NO DEBE ser 
     * agregado. 
     * 
     * El valor devuelto DEBE estar codificado en porcentaje, pero NO DEBE codificarse dos veces 
     * cualquier carácter.  Para determinar qué caracteres codificar, consulte 
     * RFC 3986, Secciones 2 y 3.4. 
     * 
     * Como ejemplo, si un valor en un par clave/valor de la cadena de consulta debe 
     * incluir un ampersand ("&") que no pretende ser un delimitador entre valores, 
     * ese valor DEBE pasarse en formato codificado (p. ej., "%26") a la instancia. 
     * 
     * @see https://tools.ietf.org/html/rfc3986#section-2 
     * @see https://tools.ietf.org/html/rfc3986#section-3.4 
     * @return string La cadena de consulta URI. 
     */
    public  function  getQuery()
    {
        return $this->query;
    }

    /** 
     * Recuperar el componente de fragmento de la URI. 
     * 
     * Si no hay ningún fragmento presente, este método DEBE devolver una cadena vacía. 
     * 
     * El carácter "#" inicial no forma parte del fragmento y NO DEBE ser 
     * agregado. 
     * 
     * El valor devuelto DEBE estar codificado en porcentaje, pero NO DEBE codificarse dos veces 
     * cualquier carácter.  Para determinar qué caracteres codificar, consulte 
     * RFC 3986, Secciones 2 y 3.5. 
     * 
     * @ver https://tools.ietf.org/html/rfc3986#section-2 
     * @ver https://tools.ietf.org/html/rfc3986#section-3.5 
     * @return string El fragmento URI. 
     */
    public  function  getFragment()
    {
        return $this->fragment;
    }

    /** 
     * Devuelve la representación de la cadena como una referencia de URI. 
     * 
     * Dependiendo de qué componentes del URI estén presentes, el resultado 
     * la cadena es un URI completo o una referencia relativa según RFC 3986, 
     * Apartado 4.1.  El método concatena los diversos componentes del URI, 
     * usando los delimitadores apropiados: 
     * 
     * - Si hay un esquema presente, DEBE tener el sufijo ":". 
     * - Si una autoridad está presente, DEBE tener el prefijo "//". 
     * - La ruta se puede concatenar sin delimitadores.  pero hay dos 
     * casos en los que la ruta debe ajustarse para hacer la referencia URI 
     * válido ya que PHP no permite lanzar una excepción en __toString(): 
     * - Si el camino no tiene raíz y hay una autoridad presente, el camino DEBE 
     * tener el prefijo "/". 
     * - Si la ruta comienza con más de un "/" y no hay autorización 
     * presente, las barras iniciales DEBEN reducirse a uno. 
     * - Si hay una consulta presente, DEBE tener el prefijo "?". 
     * - Si hay un fragmento presente, DEBE tener el prefijo "#". 
     * 
     * @ver http://tools.ietf.org/html/rfc3986#section-4.1 
     * cadena @return 
     */
    public function __toString()
    {
        return static::strUri(
            $this->getScheme(),
            $this->getAuthority(),
            $this->getPath(),
            $this->getQuery(),
            $this->getFragment()
        );
    }

    /**
     * Convertir URI en string.
     * 
     * Devuelve todos los componentes de la URI en un string.
     * 
     * @param string $scheme
     * @param string $authority 
     * @param string $path
     * @param string $query
     * @param string $fragment
     * @return string
     **/
    static function strUri(String $scheme = null, String $authority = null, String $path = null, String $query = null, String $fragment = null): String
    {
        $uri = '';
        if (!empty($scheme)) {
            $uri .= "$scheme:";
        }

        if (!empty($authority)) {
            $uri .= "//$authority";
        }

        $uri .= (!empty($path)) ? $path : '/';

        if (!empty($query)) {
            $uri .= "?$query";
        }

        if (!empty($fragment)) {
            $uri .= "#$fragment";
        }

        return $uri;
    }
}
