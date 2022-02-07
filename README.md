## Ekran agent

Ekran is a simple server monitoring agent for your servers.
### TODO
- [x] Linux agent
- [ ] Windows agent
- [ ] Add database options for historical tracking.
- [ ] Additional tracking options

### Requirements
* This package does use "exec" function to read cpu, memory and process list. So you should enable it for php-cli apps

### Installation

* Clone this repository to server you want to watch
* Run `composer install`
* Copy `.env.example` to `.env`
* Create an account on [Pusher](https://www.pusher.com) and put your credentials in `.env`
* Add `agent.php` to crontab.

> Service names should be separated with colon (`:`)
### GUI
Please check GUI for a frontend

