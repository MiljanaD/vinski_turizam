FROM httpd:2.4.33-alpine
WORKDIR /application

EXPOSE 80

RUN apk update; \
    apk upgrade;

RUN sed -i '/LoadModule rewrite_module/s/^#//g' /usr/local/apache2/conf/httpd.conf

RUN echo -e "Include /usr/local/apache2/conf/vinskit.local.conf" \
    >> /usr/local/apache2/conf/httpd.conf