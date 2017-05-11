## Warning & Intentions

This is very much a work in progress and needs some TLC to be ready for experimental, let alone production use.
Do not expect a production ready memoryhole instance on the other side of this.
This is an adaptation of an approach to deploying memoryhole instances that has been very siloed and driven by crisis-centered work thusfar.

Eventually, the plan is to turn this into a project that is ready to go and can be pulled right off the shelf, and to empower folks all over with memoryhole.

If you are looking for a project that is good to go, please check back soon.

## What is MemoryHole?

*TODO*

## Setup

Setup a city using cities/example as a starting point.

1. In the repository base, create a directory called `cities`
2. Create a cities/<example> directory
3. use the config.example.yml to create a config.yml for that city
4. Point to that cities/<example> directory in the below commands for each city that you deploy memoryhole for
5. The cities/<example> directory should contain:
   - `config.yml`
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



## Development/Contributing

### Requirements
- Vagrant
- VirtualBox
- Ansible (see above)

### Running in a Vagrant box

1. In the project root, run `vagrant up`. It will run the vagrant provisioning scripts.
2. If there is a failure and you need to re-run the ansible file provisioning steps, run `vagrant provision`
3. If you need to pass more custom arguments to the ansible scripts, see [the documentation](https://www.vagrantup.com/docs/provisioning/ansible.html) for running ansible in a Vagrantfile

### Priorities
See the [github issues](https://github.com/mtwg/memoryhole-ansible/issues) to see what our priorities are.

## Deprecated

The Makefile is deprecated. Feel free to bring them back to life if you want!

