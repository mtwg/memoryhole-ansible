## MemoryHole?

Memoryhole is a highy specialized SugarCRM fork used by Mass Defense lawyers to protect the constitutional rights of demonstrators across the US.
I did not create MemoryHole. It was created in 2012 I believe by some incredible folks on the west coast of the US as government repression increased during rising mass mobilizations.  
Mass defense lawyers at the NLG, BMLP and other wonderful organizations have asked for a click-and-deploy but secure setup for any city, and this is the closest I got to it for now.  
It may seem oldschool, but after research and security audits it remains a pretty solid app for what it's good for. Constitutional Rights organizations don't exactly have the budgets to rebuild something on this scale, and why rebuild something that works great already?

## How to deploy

Below are instructions on how to deploy memoryhole to a CentOS VPS. You can try the 'quick instructions' option but you will need to pay close attention and go step by step.

### Quick instructions

For a quick, mostly automated attempt at the below, use this command:

- make && make deploy

You will need gcc, xcode, etc whatever in your OS provides make. Otherwise you'll need to follow the steps below.

### Select a VPS

Because the CIS ansible role is focused on the CentOS CIS Benchmark, we are going to specifically use CentOS 6.7. And for whatever reason, not the Linode image. I chose a 1mb DigitalOcean VPS using the CentOS 6.x x86 image. Should work out of the blue! If there are any OS specific issues for newer versions of CentOS 6.x please let me know in the issue queue.

Make sure that it has root ssh access using your public key only. No passwords allowed! The CIS script will disable password auth, and remote root auth.

### Set up repository
Now, clone this repository to your local machine.

``git clone this-repo-url ~/projects/memoryhole-deployment`` or wherever

Preferrably your local machine has either a fully encrypted drive, or an encrypted home folder that you are cloning to, since you will have passwords hanging out in plaintext.

``git submodule init`` will download relevant git repositories that you will need.

### Define Hosts

Edit ``cities/<CITY KEY>/hosts`` and add the appropriate IP(s) you want to deploy the instance to under ``[memoryhole]``

### Run the CIS script

The CIS ansible script needs to be run first in an isolated fashion.  Please report issues with it to the relevant repository as referenced.

``ansible-playbook -i cities/{{city_key}}//hosts runalone/cis-rhel-ansible/playbook.yml``

You may get errors but it's ok, try running each of the specific tags as the documentation indicates. This script has a very difficult job to do.

### Configure application for deployment
Now, copy ``config.example.yml`` to ``config.yml``

Change the configuration options to suit your install. Choose strong passwords, preferrably using the openssl command or something with encryption-level randomness.

### Configure the application enumerations and strings

All the enumerations for things like uses of forces, charge types, etc live here:

``app/custom/includes/language/en_us.lang.php``

You will need to populate these manually for your particular legal team and then blow out the application cache. It's easiest to edit these lists before you cities/<CITY KEY>/.

Yes in today's world we would have folks be able to customize this themselves, but for now this is our best option.

### Generate Certificates

For SSL/TLS encryption, which we think of as an absolute for decent security (SSL/TLS is not in itself bullet-proof, but better than non-encrypted communications between user and server) one could generate their own certificates, but this is a generally less secure method for encryption for a number of reasons.  We have written in language to automate the uploading and include instructions for the creation of encryption certificates through the Let's Encrypt project, which issues automated, signed encryption certificates that are accepted by major browsers as legitimate, and that are backed by the Mozilla Foundation, Linux Foundation and Electronic Frontier Foundation.  

To create the certificates, the certificate chains and the certificate key:
git clone https://github.com/letsencrypt/letsencrypt
cd letsencrypt
./letsencrypt-auto certonly --manual --email admin@thing.com -d thing.com --agree-tos		

 Replace -d thing.com with your actual domain or subdomain and --email admin@thing.com with the actual email for the admin.

 Move the contents generated to the ..cities/<CITY KEY>/certificates folder for the appropriate city.

When the Ansible playbook runs it will automatically upload and point Apache to the certificates.

Certificate Renewal

Let's Encrypt certs are only valid for 90 days currently.  When the automatic renewal tool is released by the project we will update the playbook to automatically generate self-renewing certificates.  For now, just make sure to run the letsencrypt-auto script once every three months and then run the Ansible playbook to automatically upload the new certificates.

In future versions of this repository, after Let's Encrypt adds better support for CentOS and better automatic renewal tools, this process will likely be completely automated on the server side.


### Initialize CentOS Box

This script will set up a few things while using the root user. Only these few commands will be run over SSH by the root user ever.

``$: ansible-playbook cities/<CITY KEY>/server.yml -i hosts``

### Deploy the application
This will install and configure a secure mysql, set up the application database, place the certificates, set up apache, and configure the application.

``$: ansible-playbook build.yml -i hosts``

### Voila!

Now, go to https://your-application-host, accept the 'invalid' security certificate and access the admin UI using your provided login credentials.

### Troubleshooting

#### I get an error with /etc/grub.cfg (or similar)

This seems to be caused by either
a) Linode's CentOS 6.5 image (however their UI boot controls it maybe?) and/or
b) The CentOS 7 image which uses grub2

To ameliorate this issue, use CentOS 6.5 somewhere other than Linode, or skip the problematic steps with --skip-steps flag

### SSH Connection issues

Always try manually connecting and/or using -vvvv to see what parameters it is trying to pass.

The authorized_keys ansible param is going to expect to find the default id_rsa.pub in your home directory. If this isn't the case, change this in init.yml. I guess it should be a config option huh

### XYZ problem with ansible

Gahh I'm tired. Ansible issues can be troubleshooted by searching about ansible related things.

## How to develop

**Currently Vagrantfile not configured for new ansible config**

Use 'vagrant up'. It will import a fancy basebox so make sure you have a strong connection.

Currently some mount (shared directory in vagrant)/SELinux conflicts prevent external access to port 80 on the proper directory, but at least it will deploy and set up everything as it should be on the server.
