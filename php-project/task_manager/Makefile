NO_COLOR=\x1b[0m
OK_COLOR=\x1b[32;01m
ERROR_COLOR=\x1b[31;01m
WARN_COLOR=\x1b[33;01m

all: phpab tests testdox cov

phpab:
	php phpab.phar -o src/autoload.php src
	php phpab.phar -o tests/autoload.php src tests

test:
	php phpunit.phar -c phpunit.xml.dist tests

testdox:
	@php phpunit.phar -c phpunit.xml.dist --testdox tests \
	 | sed 's/\[x\]/$(OK_COLOR)$\[x]$(NO_COLOR)/' \
	 | sed -r 's/(\[ \].+)/$(ERROR_COLOR)\1$(NO_COLOR)/' \
	 | sed -r 's/(^[^ ].+)/$(WARN_COLOR)\1$(NO_COLOR)/'

testdox-osx:
	@php phpunit.phar -c phpunit.xml.dist --testdox tests \
	 | sed 's/\[x\]/$(OK_COLOR)$\[x]$(NO_COLOR)/' \
	 | sed -E 's/(\[ \].+)/$(ERROR_COLOR)\1$(NO_COLOR)/' \
	 | sed -E 's/(^[^ ].+)/$(WARN_COLOR)\1$(NO_COLOR)/'

cov:
	@php phpunit.phar -c phpunit.xml.dist --coverage-text

a: phpab

c: cov

t: test

d: testdox
