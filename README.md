# MasterLingua
Самописный сайт частной школы иностранных языков

## Стек технологий
* HTML
* CSS
* JavaScript
* PHP

## Локальная разработка
1. `git clone https://github.com/paulcervov/masterlingua.git`
2. `git remote set-url origin https://<YOU_ACCESS_TOKEN>@github.com/paulcervov/masterlingua.git`
3. `php -S localhost:8000 -t public_html/`
   
## Деплой в продакшн
1. 'git reset --hard'
2. 'gist status (убеждаемся что изменения откатились)'
3. 'git push'
4. 'идем в admin/includes/database.php и прописываем путь до базы'
