#ifndef PHP_STREAMFD_H
# define PHP_STREAMFD_H

extern zend_module_entry streamfd_module_entry;

# define PHP_STREAMFD_VERSION "0.1.0"

# if defined(ZTS) && defined(COMPILE_DL_STREAMFD)
ZEND_TSRMLS_CACHE_EXTERN()
# endif

#endif