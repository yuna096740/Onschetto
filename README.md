<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# ONschetto (オン助っ人)
![スクリーンショット 2023-09-18 午後11 27 00](https://github.com/yuna096740/Laravel_lesson/assets/129647184/6c99b937-43de-43c1-8429-26174f7dc957)

## 概要
`ONschetto` はシンプルなデザインとクールなレイアウトのスケジュール管理アプリです。<br>
簡単に予定を追加、編集ができる為スケジュール管理の `助っ人` となります。<br>
数日にまたぐ予定も可視化されているので管理が楽になります。<br>
開発環境はDockerを使用し、PHP/Laravel で個人製作したポートフォリオです。

## 使用イメージ




## 製作経緯
  日々の学習の管理でスケジュールアプリを使用していますが、とても動作が重く感じておりました。<br>
スケジュールを確認したい時は決まって急いでいる時が多い私は、`必要な機能だけが揃っている、且つ軽量なスケジュールアプリが欲しい。`と思いカレンダーアプリを製作しました。


## 使用技術

- PHP v8.2.10
- LARAVEL v10.22.0
- Docker/docker-compose
- Git, GitHub
- tailwind
- JavaScript
  - FullCalendar
  - axios
## Docker構成
```
  ONschetto
  |- docker
  |  |- mysql
  |  |   L many
  |  |- nginx
  |  |   |- logs
  |  |   |- default.conf
  |  |   |- Dockerfile
  |  |- PHP
  |     |-Dockerfile
  |     |-php.ini
  |- docker-compose.yml
```
## 機能一覧
- 認証機能
  - ユーザーログイン、登録, 退会
  - ユーザーパスワードの再設定
- スケジュール
  - CRUD
  - 検索機能

## 製作で意識した点
- ユーザーがストレスなく利用できるかを意識し製作に努めました。
  - 予定新規登録の際にフォームにFullCalendarから取得した日付情報を表示し登録できるようにしました。
  - 日付を押下した際にその日付をフォームに表示し登録できるようにしました。
  - 予定の色をフォームで選べるようにし予定の判別を行い易くしました。
  - 予定のタイトル、日付、またその両方からの検索を行えるようにし、予定の確認を行い易くしました。
  - 黒と紫をベースに、デザインを統一化しました。
