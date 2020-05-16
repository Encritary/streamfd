PHP_ARG_ENABLE(streamfd, whether to enable streamfd extension, [ --enable-streamfd Enable streamfd extension], no)

if test "$PHP_STREAMFD" != "no"; then
  PHP_NEW_EXTENSION(streamfd, streamfd.c, $ext_shared)

  PHP_ADD_MAKEFILE_FRAGMENT
fi
