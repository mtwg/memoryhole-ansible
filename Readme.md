## Warning & Intentions

This is very much a work in progress and needs some TLC to be ready for experimental, let alone production use.
Do not expect a production ready memoryhole instance on the other side of this.
This is an adaptation of an approach to deploying memoryhole instances that has been very siloed and driven by crisis-centered work thusfar.

Eventually, the plan is to turn this into a project that is ready to go and can be pulled right off the shelf, and to empower folks all over with memoryhole.

If you are looking for a project that is good to go, please check back soon.

## What is MemoryHole?

Memoryhole is a highy specialized SugarCRM fork used by Mass Defense lawyers to protect the constitutional rights of demonstrators across the US. I did not create MemoryHole. It was created in 2012 I believe by some incredible folks on the west coast of the US as government repression increased during rising mass mobilizations.


## Setup (last updated Apr 15 2017)

These setup instructions were done on a Mac. This instructions DO NOT yield a secure server yet. The instructions in the 'Post Run' step must be followed for the server to be secure.

## Set up VPS with hosts

In order to continue, you'll need to set up a VPS with a hosting provider (as below) or run it locally using VirtualBox / Vagrant

- [DigitalOcean](docs/hosts/digitalocean.md)
- [Linode](docs/hosts/linode.md)
- [Amazon AWS](docs/hosts/aws.md)
- [Local (Vagrant)](#running-in-a-vagrant-box)

### Set up required libraries/tools. Do this on your computer.

1. Install brew - best to follow instructions [here](https://brew.sh/)
2. Install ansible-playbook, openssl. Run the following in the Terminal app.

```bash
brew install ansible openssl
```

3. Clone this repository. If you're on a Mac, git should be installed, otherwise, do `brew install git` if you run into errors with the line below.
```bash
git clone git@github.com:mtwg/memoryhole-ansible.git
cd memoryhole-ansible
```

4. Install ansible roles
```bash
ansible-galaxy install -r requirements.yml --roles-path=deploy/roles
```

1. You should now be in the memoryhole-ansible folder. In here, create a a `cities/<example>` directory, where <example> might be something like 'newyork'. So, everywhere in this guide where you see <example>, you should replace it with `newyork`
```bash
mkdir cities/<example>
```
2. Copy examples/config.yml and hosts to create a config.yml for that city under the `cities/<example>` folder.
```bash
cp cities/example/* cities/<example>
```
3. The cities/<example> directory should contain:
  - the `config.yml` file
  - a file called `hosts` that looks like:
     ```
     [memoryhole]
     <your-hoar-ip-address>
     ```
     Wherein the above IP is the IP address of the server you had created earlier. See the cities/example/hosts file.

4. Edit the config.yml file. This instructions do not yet yield a secure server, but it is critical to change the database and admin password from the default.

### Run the server.

```bash
ansible-playbook -i cities/<example>/hosts deploy/server.yml -e city_key=<example>
```
then

```bash
ansible-playbook -i cities/<example>/hosts deploy/deploy.yml -e city_key=<example> -v
```

After this command runs, you should be able to see an instance of memoryhole running at the host you specified. Use the values from app_user and app_password in your config.yml to login.

## Post-Run
(Note: these tasks will soon be automated ;)

I usually:
- install cerbot & run `certbot --webroot --apache -d your.domain.name`. choose the most secure option
- you may have to manually change the apache config, but usually not.
- install `apt-get install fail2ban`
- disable root ssh in `/root/.ssh/config`
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


## TODO (outdated - see issue queue)
- [ ] Fix Ansible scripts for Debian Jessie base box
- [ ] Add letsencrypt, security monitoring, hardening, and other manual steps to the ansible deployment
- [ ] Provide a new and improved Makefile to streamline tasks
- [ ] Add maintenance, backup, emergency tasks
- [ ] Support a variety of architectures
- [ ] Reorganize into a role
