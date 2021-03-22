#!/bin/bash

echo "step 1 - Atualizando os pacotes"
docker exec api-lumen composer install
