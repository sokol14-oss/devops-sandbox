FROM nginx:latest
COPY ./conf/landing.conf /etc/nginx/conf.d/landing.conf
COPY ./snippets /etc/nginx/snippets
COPY fastcgi.conf /etc/nginx/fastcgi.conf
COPY .htpasswd /etc/nginx/.htpasswd
EXPOSE 80
