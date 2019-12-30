FROM php:7.4.1-alpine

ENV PHP_MEMCACHED_VERSION 3.1.5

RUN apk add --no-cache libmemcached-dev libmcrypt-dev php7-zlib php7 php7-dev gcc musl-dev g++ make \
    && pecl install redis \
    && docker-php-ext-enable redis.so \
    && curl -L -o /tmp/memcached.tar.gz "https://github.com/php-memcached-dev/php-memcached/archive/v${PHP_MEMCACHED_VERSION}.tar.gz" \
    && mkdir -p memcached && \
	tar -C memcached -zxvf /tmp/memcached.tar.gz --strip 1 && \
	( \
	    cd memcached && \
	    phpize && \
	    ./configure --with-libmemcached-dir=/usr/include/libmemcached/ && \
	    make -j$(nproc) && \
	    make install \
	) && \
	rm -r memcached && \
	rm /tmp/memcached.tar.gz && \
	docker-php-ext-enable memcached

COPY test_memcached.php /opt/test_memcached.php
COPY test-redis.php /opt/test-redis.php
COPY check-memcache.php /opt/check-memcache.php
COPY docker-entrypoint.sh /opt/docker-entrypoint.sh

WORKDIR ["/opt"]

CMD ["/opt/docker-entrypoint.sh"]
