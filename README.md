# backpacker-rbac

## For ubuntu

```
sudo apt install docker-compose
cd ~/repos/projects/backpacker-rbac
docker-compose up -d --build
sudo vi /etc/hosts
```
add 127.0.0.1 rbac.backpacker.loc to the end of hosts file

go to http://rbac.backpacker.loc in your browser

## sass
```shell
sass public/assets/vendor/bootstrap/scss/bootstrap.scss public/assets/custom/bootstrap/css/bootstrap.css
```