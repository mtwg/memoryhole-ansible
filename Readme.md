## Setup

Setup a city using cities/example as a starting point

## Run

```bash
ansible-playbook -i cities/example/hosts deploy/server.yml -e city_key=dc
```
then

```bash
ansible-playbook -i cities/example/hosts deploy/deploy.yml -e city_key=dc -v
```

## Post-Run

I usually:
- run certbot
- manually change the apache configs
- install fail2ban
- disable root ssh
- install and configure https://github.com/BinaryDefense/artillery
