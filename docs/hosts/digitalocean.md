## Set up a Digital Ocean Droplet
This setup instruction uses a Digital Ocean as the hosting solution, using the Debian 8.7 x64 droplet. Make sure to select this droplet!

See [here](https://www.digitalocean.com/community/tutorials/how-to-create-your-first-digitalocean-droplet-virtual-server) for instructions on how to create a droplet. These instructions are summarized below:

### Select the Debian 8.7 x64 droplet. Make sensible choices for the rest of the options:

![Select droplet](/docs/assets/select-droplet.png)

### Make sure you add an ssh key to the droplet

![Add ssh keys](/docs/assets/addsshkeys.png)

When going through the set up steps, its important to add an ssh key to the server. If you do not have an ssh key, you need to create one. Even if you do have one, read carefully - the droplet seems to not take rsa keys(id_rsa, id_rsa.pub), but accepts a Ed25519 key. To generate one:

```bash
ssh-keygen -t ed25519
```

When prompted for the directory to save in, you can just use the default: `~/.ssh`. Enter a passphrase if necessary.

After generating this, you need to make sure this key is added to the droplet. This is usually found at ~/.ssh/id_ed25519.pub

### You're done! Take note of the ip address, it will be used in the steps below:

![Add ssh keys](/docs/assets/server-ip.png)
