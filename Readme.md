## Setup

Setup a city using cities/example as a starting point.

1. In the repository base, create a directory called `cities`
2. Create a cities/<example> directory
3. use the config.example.yml to create a config.yml for that city
4. Point to that cities/<example> directory in the below commands for each city that you deploy memoryhole for
5. The cities/<example> directory should contain:
   - config.yml
   - a file called `hosts` that looks like:
     ```
     [memoryhole]
     192.168.0.1
     ```
     Wherein the above IP is the IP address or hostname of deployment target (used as an SSH target)

## Run

```bash
ansible-playbook -i cities/<example>/hosts deploy/server.yml -e city_key=dc
```
then

```bash
ansible-playbook -i cities/<example>/hosts deploy/deploy.yml -e city_key=dc -v
```

## Post-Run

I usually:
- run certbot
- manually change the apache configs
- install fail2ban
- disable root ssh
- install and configure https://github.com/BinaryDefense/artillery

## Deprecated

Vagrant and the Makefile are deprecated. Feel free to bring them back to life if you want!
