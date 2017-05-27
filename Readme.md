## Introduction

- Local Vagrant Instance: :two_hearts: Currently working :two_hearts:
- Deploying to a VPS: Needs work, self-signed SSL vs letsencrypt are clashing
- These instructions work on a MacOSX machine. Please open any issues you have with other environments.

## What is MemoryHole?

Memoryhole is a highy specialized SugarCRM fork used by Mass Defense lawyers to protect the constitutional rights of demonstrators across the US.

## Set up VPS with hosts

In order to continue, you'll need to set up a VPS with a hosting provider (as below) or run it locally using VirtualBox / Vagrant

- [DigitalOcean](docs/hosts/digitalocean.md)
- [Linode](docs/hosts/linode.md)
- [Amazon AWS](docs/hosts/aws.md)
- [Local (Vagrant)](#vagrant) (running in a local vagrant box allows you to bypass using a VPS, which is great for testing and potentially ok for small-scale, local network deployments.)

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
### Configure your memoryhole instance

1. You should now be in the memoryhole-ansible folder. In here, create a a `cities/<your city>` directory, where <your city> might be something like 'newyork'. So, everywhere in this guide where you see <your city>, you should replace it with `newyork`
```bash
mkdir cities/<your city>
```
2. Copy `cities/examples/config.yml` and `cities/examples/hosts` to create a config.yml for that city under the `cities/<your city>` folder.
```bash
cp cities/example/* cities/<your city>
```
Here are the configuration parameters you will see:

property | required? | default? | description
--|---|---|--
sys_access_user | no  | root | use this to specify which user should set up the services and should have ssh login left enabled
sys_access_user_pub_key_file | no | ~/.ssh/id_rsa.pub | this key is added to the authorized keys for the sys_access_user
letsencrypt_email | yes | none | this email address will receive notifications about certificates expiring soon
mysql_root_user| yes | root | choose an alternate name for the root mysql user for security hardening purposes
mysql_root_password|yes|n/a|asecure root password to use for the root mysql user
mysql_app_user|yes|n/a|the user that memoryhole uses to access the app database
mysql_app_password|yes|n/a|the secure password for the app database user
mysql_app_db_name|yes|n/a|the name of the database used for the application
app_user|yes|n/a|the username for the admin user to be created with the app
app_password|yes|n/a|the password for the admin user created with the app
app_domain|yes|n/a| the app domain without the protocol prefix, aka the "FQDN". e.g. memoryhole.myhost.com
app_email_from_address|yes|n/a|the email address that system emails are sent to users from. password reset, etc.
app_calendar_embed_url|no|n/a|the url of the google calendar to embed on the calendars tab if necessary
app_email_smtp|yes|n/a|several nested properties that allow users to send outbound email. required to create users.
app_email_smtp.host|yes|n/a|the hostname for the email server. see your email's config
app_email_smtp.user|yes|n/a|the username for the email server
app_email_smtp.password|yes|n/a|the password for the email server
app_email_smtp.port|no|465|the port for the email server.
app_email_smtp.ssl|no|1|whether to use ssl encryption. 1=true, 0=false


3. The cities/<your city> directory should contain:
  - the `config.yml` file
  - a file called `hosts` that looks like:
     ```
     [memoryhole]
     <your-VPS-ip-address>
     ```
     Wherein the above IP is the IP address of the server you had created earlier. See the cities/example/hosts file.

4. Edit the config.yml file. It is critical to change the database and admin password from the default. Also, be sure to configure your email settings now rather than later.

### Option 1: Run the server.

```bash
ansible-playbook -i cities/<your city>/hosts deploy/server.yml -e city_key=<your city>
```

### Option 2: Run in a Vagrant box
<a href="#vagrant"></a>
This allows you to run/test the application locally. Someone outside of your local network will not be able to access the application using this approach.

#### Requirements

- Vagrant - https://www.vagrantup.com/downloads.html
- VirtualBox - https://www.virtualbox.org/wiki/Downloads (choose the proper item under "platform packages")
- Ansible (see above)

#### Steps

1. In the project root, run `vagrant up`. It will run the vagrant provisioning scripts.
2. If there is a failure and you need to re-run the ansible file provisioning steps, run `vagrant provision`
3. If you need to pass more custom arguments to the ansible scripts, see [the documentation](https://www.vagrantup.com/docs/provisioning/ansible.html) for running ansible in a Vagrantfile

## Voila!

After this command runs, you should be able to see an instance of memoryhole running at the host you specified. Use the values from app_user and app_password in your config.yml to login.

## Post-Run
(Note: these tasks will soon be automated )

install and configure https://github.com/BinaryDefense/artillery

## Development/Contributing

### Priorities
See the [github issues](https://github.com/mtwg/memoryhole-ansible/issues) to see what our priorities are.

## Deprecated
The Makefile is deprecated. Feel free to bring them back to life if you want!
