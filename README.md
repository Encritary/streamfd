# streamfd
[![Build Status](https://travis-ci.org/Encritary/streamfd.svg?branch=master)](https://travis-ci.org/Encritary/streamfd)

A simple PHP extension that allows you to get the FD of a stream resource.

# Building
```
git clone https://github.com/Encritary/streamfd.git
cd streamfd
phpize
./configure --enable-streamfd
make && make test && sudo make install
```

# Usage

The extension adds only one new PHP function:

``streamfd(resource $stream) : int|bool``

It will return the file descriptor (a positive integer) of the given stream resource, or ``false`` if an error occurs.
