# Run mysql image
docker run	--name db \
			-e MYSQL_ROOT_PASSWORD=123456 \
			-e MYSQL_DATABASE=homestead \
			-e MYSQL_USER=homestead \
			-e MYSQL_PASSWORD=secret \
			mysql:5.6

# Create app image
docker build -t dockerfinaltraining .

# Run image
docker run 	--name dockerfinaltraining \
			--link db:mysql-server \
			-p 80:80 \
			-v /home/alejandro/data/dockerfinal/worldapi:/opt/www/worldapi \
			dockerfinaltraining
   
