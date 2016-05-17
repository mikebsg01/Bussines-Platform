mv * ../
mv .* ../

echo "All files are ready!"

cd ..
rm .env
rm .env.example
mv .production .env

echo "Environment ready!"

rm -rf Bussines-Platform

php artisan migrate:refresh --seed

echo "Database created!"

rm deploy.sh

echo "Finished!"