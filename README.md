# スレッド式掲示板

dockerとphp（laravel）で作成したスレッド式掲示板です．

## 機能
- **記事の投稿**
  - アカウントを作成しログインすることで，自分のユーザ名で記事を投稿することができます
- **投稿された記事の閲覧**
  - スレッド一覧画面から，これまでに投稿された記事の一覧を見ることができます．
  - 記事のタイトルをクリックすることでスレッド詳細画面に移動し，その記事への返信の一覧を見ることができます．
- **投稿された記事への返信**
  - スレッド詳細画面から，その記事に対する返信を投稿することができます．
- **自分が投稿した記事の編集・削除**
  - スレッド一覧画面から，自分が投稿した記事を編集・削除することができます．
  - 記事が削除されると，その記事への返信もまとめて削除されます．
- **自分が投稿した返信の編集・削除**
  - スレッド詳細画面から，自分が投稿した返信を編集・削除することができます．
- **管理者権限による記事の強制編集・削除**
  - データベースにて，usersテーブルのroleカラムにadminを設定することで，
    そのユーザは管理者となり，自分が投稿したかに関わらず記事を編集・削除できます．
- **管理者権限による返信の強制編集・削除**
  - データベースにて，usersテーブルのroleカラムにadminを設定することで，
    そのユーザは管理者となり，自分が投稿したかに関わらず記事への返信を編集・削除できます．
    
## ローカルでの動作確認手順
1. Dockerをインストールし，起動しておきます．
2. このリポジトリをcloneし，リポジトリ内に移動します．
```
$ git clone https://github.com/yito0424/bbs.git && cd bbs
```
3. Dockerコンテナを起動します．
```
$ docker compose up -d --build
```
4. コンテナが起動したことを確認します．
```
$ docker compose ps
  NAME                SERVICE             STATUS              PORTS
  bbs_app_     1      app                 running             9000/tcp
  bbs_db_1            db                  running (healthy)   3306/tcp, 33060/tcp, 33061/tcp
  bbs_web_1           web                 running             0.0.0.0:10080->80/tcp, :::10080->80/tcp
```
5. appコンテナに入り，bashを起動します．
```
$ docker compose exec app bash
```
6. composerをインストールします．
```
[app] $ composer install
```
7. .env.exampleをコピーして.envファイルを作成します．
```
[app] $ cp .env.example .env
```
8. Laravelのアプリケーションキーを設定します．
```
[app] $ php artisan key:generate
```
9. データベースのマイグレーションを行います．
```
[app] $ php artisan migrate
```
10. appコンテナの外に出ます．
```
[app] $ exit
```
11. `http://127.0.0.1:10080/`にアクセスします．
12. 以下の画面が表示されれば成功です．右上のRegisterボタンからアカウントを作成します．
<img src='https://user-images.githubusercontent.com/62548441/121713831-398b0d80-cb18-11eb-9b8f-bf4f98379ba2.png' width = 500px>

## 管理者権限の設定方法
1. dbコンテナに入り，bashを起動します．
```
$ docker compose exec db bash
```
2. データベースにログインします．
```
[db] $ mysql -u $MYSQL_USER -p$MYSQL_PASSWORD $MYSQL_DATABASE
```
3. 管理者権限を設定したいユーザのidを指定し，roleカラムにadminを設定します．
```
[mysql] $ update users set role='admin' where id={your_id};
```

## 画面一覧
- ホーム画面
<img src='https://user-images.githubusercontent.com/62548441/121716650-3c3b3200-cb1b-11eb-89cc-01fc9bdee3b9.png' width = 500px>

- スレッド一覧画面
<img src='https://user-images.githubusercontent.com/62548441/121716648-3c3b3200-cb1b-11eb-97a8-a18f3500a136.png' width = 500px>

- 新規スレッド投稿画面
<img src='https://user-images.githubusercontent.com/62548441/121716646-3ba29b80-cb1b-11eb-8baa-d9cf50e10880.png' width = 500px>

- スレッド詳細画面
<img src='https://user-images.githubusercontent.com/62548441/121716645-3ba29b80-cb1b-11eb-803e-89c964134f9c.png' width = 500px>

- スレッド編集画面
<img src=https://user-images.githubusercontent.com/62548441/121716641-3a716e80-cb1b-11eb-93d2-24ff844e36ad.png width = 500px>

- 返信編集画面
<img src='https://user-images.githubusercontent.com/62548441/121716644-3b0a0500-cb1b-11eb-99c2-88d0aaec4517.png' width = 500px>
