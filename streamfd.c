#ifdef HAVE_CONFIG_H
# include "config.h"
#endif

#include "php.h"
#include "ext/standard/info.h"
#include "php_network.h"

#include "php_streamfd.h"

PHP_FUNCTION(streamfd){
	zval *zstream;
	php_stream *stream;
	php_socket_t fd;

	ZEND_PARSE_PARAMETERS_START(1, 1)
		Z_PARAM_RESOURCE(zstream)
	ZEND_PARSE_PARAMETERS_END();

	php_stream_from_zval(stream, zstream);

	if(FAILURE == php_stream_cast(stream, PHP_STREAM_AS_FD, (void**) &fd, 1)){
		RETURN_FALSE;
	}

	RETURN_LONG(fd);
}

ZEND_BEGIN_ARG_INFO(arginfo_streamfd, 0)
	ZEND_ARG_INFO(0, fp)
ZEND_END_ARG_INFO()

static const zend_function_entry streamfd_functions[] = {
	PHP_FE(streamfd, arginfo_streamfd)
	PHP_FE_END
};

zend_module_entry streamfd_module_entry = {
	STANDARD_MODULE_HEADER,
	"streamfd",
	streamfd_functions,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	PHP_STREAMFD_VERSION,
	STANDARD_MODULE_PROPERTIES
};

#ifdef COMPILE_DL_STREAMFD
# ifdef ZTS
ZEND_TSRMLS_CACHE_DEFINE()
# endif
ZEND_GET_MODULE(streamfd)
#endif