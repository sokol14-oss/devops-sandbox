FROM nginx:latest
# Копируем твой конфиг внутрь контейнера
COPY ./conf/landing.conf /etc/nginx/conf.d/landing.conf
# Копируем файлы твоего сайта
COPY ./snippets /etc/nginx/snippets
COPY fastcgi.conf /etc/nginx/fastcgi.conf
COPY .htpasswd /etc/nginx/.htpasswd
EXPOSE 80
