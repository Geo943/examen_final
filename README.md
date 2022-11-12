# SistemaDeMarcaje
Proyecto 1, Sistema de marcaje web que esta conformado por el frontend  Angular 13,backend Laravel 9


# Instalación en WEB-APP FreeBSD (192.168.1.30)

--instalacion y configuración de nginx

Creacin de usuario dev

    adduser dev pass: dev grupo wheel
  
Configuración SSH

Cambio de ip estatica en archivo /etc/rc.conf (ip 1.30 para server app)
   
    ifconfig_vmx0="inet 192.168.1.30 netmask 255.255.252.0"
   
    defaultrouter="192.168.1.30"
    
  pkg install nano
  
  pkg install nginx
  
    echo 'nginx_enable="YES"' >> /etc/rc.conf
    
    /usr/local/etc/rc.d/nginx start
    
    usuario dev para desarrollo
    
    creacion de directorio para archivos /wwwapp/
    
      solo permisos para usuario dev
      
      chown -R dev:dev /wwwapp/
      
      chmod -R 777 /wwwapp/
      
    agregar ruta de domino
    
      mkdir /usr/local/etc/nginx/vdomains/
      
      nano /usr/local/etc/nginx/vdomains/http.192.168.1.30.conf
      
      Agregar:
      
        server {
                server_name 192.168.1.30;
                access_log  /var/log/nginx/192.168.1.30.access.log; 
                error_log  /var/log/nginx/192.168.1.30.error.log;
                root /wwwapp;  
              }
              
      agregar en archivo:
      
      /usr/local/etc/nginx/nginx.conf
      
        include "vdomains/*.conf";
        
    recargar servico
   
    service nginx reload
  
  Instalacion/configuración de php, composer
    
    pkg install php73
    
    pkg install php74-composer-1.10.26 php74-composer2-2.3.7
    
  Instalación/configuración de git
  
    sudo pkg install git
    
    git config --global user.name "nombre"
    
    git config --global user.email "email@"
    
# Instalación en BD UbuntuServer (192.168.1.22)

  Creacion de usuario dev pass: dev grupo sudo 
  
  Configuracion SSH
 
  configuracion mysql
  
    sudo apt-get install mysql-server mysql-client
    
    sudo apt-get install php libapache2-mod-php php-mysql
    
    service mysql status
    
    GRANT ALL ON *.* TO 'dev'@'localhost' IDENTIFIED BY 'dev123' WITH GRANT OPTION;
    
    FLUSH PRIVILEGES;
    
    CREATE USER 'dev'@'*' IDENTIFIED BY '1234567890';
    
    GRANT CREATE, ALTER, DROP, INSERT, UPDATE, DELETE, SELECT, REFERENCES, RELOAD on *.* TO 'dev'@'localhost' WITH GRANT OPTION;
    
    FLUSH PRIVILEGES;
  
  
---------------------------------------------------------Diagramas de Flujo-----------------------------------------------------------------------------------------
  //Administrador
  
  ![Sistema de Marcaje web drawio](https://user-images.githubusercontent.com/70043963/185447897-14996ff7-2278-409b-a38f-4696456971bb.png)
  
 ---------------------------------------------------------Diagramas de Flujo-----------------------------------------------------------------------------------------//Usuario
 
  ![usuario drawio](https://user-images.githubusercontent.com/70043963/185448401-bc9ea5b7-c23a-4cb1-bc55-37f7863e7048.png)
  
  -------------------------------------------------------Diagrama BD-----------------------------------------------
  

![BD](https://user-images.githubusercontent.com/99605908/186573570-73cda1b9-a468-4d4e-a219-e373e17f7085.png)

  
  
  
