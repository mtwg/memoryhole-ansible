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

### Set up a Digital Ocean Droplet
This setup instruction uses a Digital Ocean as the hosting solution, using the Debian 8.7 x64 droplet. Make sure to select this droplet!

See [here](https://www.digitalocean.com/community/tutorials/how-to-create-your-first-digitalocean-droplet-virtual-server) for instructions on how to create a droplet. These instructions are summarized below:

#### Select the Debian 8.7 x64 droplet. Make sensible choices for the rest of the options:

![Select droplet](/assets/select-droplet.png)

#### Make sure you add an ssh key to the droplet

![Add ssh keys](/assets/addsshkeys.png)

When going through the set up steps, its important to add an ssh key to the server. If you do not have an ssh key, you need to create one. Even if you do have one, read carefully - the droplet seems to not take rsa keys(id_rsa, id_rsa.pub), but accepts a Ed25519 key. To generate one:

```bash
ssh-keygen -t ed25519
```

When prompted for the directory to save in, you can just use the default: `~/.ssh`. Enter a passphrase if necessary.

After generating this, you need to make sure this key is added to the droplet. This is usually found at ~/.ssh/id_ed25519.pub

#### You're done! Take note of the ip address, it will be used in the steps below:

![Add ssh keys](/assets/server-ip.png)


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
git checkout debian-overhaul # right now, the working code is in a branch.
```

4. Install submodules

```bash
git submodule init
```

1. You should now be in the memoryhole-ansible folder. In here, create a a `cities/<example>` directory, where <example> might be something like 'newyork'. So, everywhere in this guide where you see <example>, you should replace it with `newyork`
```bash
mkdir cities/<example>
```
2. Copy config.example.yml to create a config.yml for that city under the `cities/<example>` folder.
```bash
cp config.example.yml cities/<example>
```
3. The cities/<example> directory should contain:
  - the `config.yml` file
   - a file called `hosts` that looks like:
     ```
     [memoryhole]
     <your-digital-ocean-ip-address>
     ```
     Wherein the above IP is the IP address of the server you had created earlier.

4. Edit the config.yml file. This instructions do not yet yield a secure server, but it is advisable to change the database and admin password from the default.

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

## Deprecated

The Makefile is deprecated. Feel free to bring them back to life if you want!

## TODO
- [ ] Fix Ansible scripts for Debian Jessie base box
- [ ] Add letsencrypt, security monitoring, hardening, and other manual steps to the ansible deployment
- [ ] Provide a new and improved Makefile to streamline tasks
- [ ] Add maintenance, backup, emergency tasks
- [ ] Support a variety of architectures
- [ ] Reorganize into a role
