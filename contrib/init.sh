#!/bin/bash

bin/console doctrine:migrations:migrate --quiet
bin/console doctrine:fixtures:load --quiet
bin/console assets:install --symlink