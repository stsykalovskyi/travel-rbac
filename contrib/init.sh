#!/bin/bash

bin/console doctrine:migrations:migrate --quiet
bin/console doctrine:fixtures:load --quiet
bin/console assets:install --symlink

for file in "EG.jpg" "HK.jpg" "HU.jpg" "IL.webp" "IT.jpeg" "JM.jpg" "MV.jpg" "NL.jpg" "TR.jpg" "US.jpeg"
do
  cp "public/assets/images/$file" "public/uploads/images/$file"
done
