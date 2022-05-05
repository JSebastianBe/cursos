# Cursos
Proyecto de ingeniería de software 1 2022-01 - Cursos

#Herramientas:
Sublime text
XAMPP

GIT
	o	Verificar que el proxy esté configurado en el git.. si existe: git config --global http.proxy http://proxyugg.mindefensa.col:8080
	o	Configurar variables globales: git config --global user.name "JSebastianBe",  git config --global user.email sebastianbm97@gmail.com, y git commit --amend --reset-author
	o	Para clonar repositorio local: git clone https://github.com/JSebastianBe/coursera-test.git 
	Clonará la rama main
	o	Para clonar una rama en específico: git checkout gh-pages
	o	Para saber en qué rama estamos: git status
	o	Para marcar antes de agregar un archivo, conjunto de archivos o directorio usar git add .
	o	Para agregar un archivo a la rama local: git commit -m “Mi primera página.” 
	o	Para agregar el commit a la rama del repositorio: git push 
	o	Para actualizar el repositorio local con lo del servidor: git pull 

COMPOSER
	composer init
	composer require bramus/router
	composer require vlucas/phpdotenv