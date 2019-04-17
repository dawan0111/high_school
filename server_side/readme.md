4과제 시간을 절약하기 위해 만든 간단한 프레임워크 입니다.

※ index.php와 같은 레벨의 폴더에 .htaccess를 생성해주세요.

.htaccess
-----
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f 
RewriteCond %{REQUEST_FILENAME} !-d 
RewriteCond %{REQUEST_FILENAME} !-l 
RewriteRule .+ index.php?url=$0 [L,QSA]
