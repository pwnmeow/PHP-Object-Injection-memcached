sudo docker run --restart always --detach --name cloudapp-auto-restart --publish=80:80 --publish=11211:11211 -ti -v /var/run/docker.sock:/var/run/docker.sock cloudapp

