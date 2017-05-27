generate-ssl-cert
=================

Generate a self-signed OpenSSL keypair. The private key will stay on the 
remote server, and the certificate will be copied back to the Ansible controller
for distribution to other hosts.

Requirements
------------

* openssl

Role Variables
--------------

```
ssl_certificate_basename: default_certificate
ssl_certificate_directory: /etc/pki/tls
ssl_certificate_ip_address: "{{ ansible_default_ipv4.address }}"
ssl_certificate_bit_length: "2048"

# Role does not clobber existing keys with same name. Set
# the force option to true to clobber.
ssl_certificate_force_generate: false

# The directory, ownership, and permissions for the generated cert
# are intentionally conservative. Not all certs will be for
# system-wide use. For special cases with permissions, override the
# dict below with new path, ownership, and permissions. All fields
# are manadatory.
ssl_certificate_permissions_map:
  basename: "{{ ssl_certificate_basename }}"
  cert:
    path: "{{ ssl_certificate_directory }}/certs/{{ ssl_certificate_basename }}.crt"
    mode: "0644"
    owner: root
    group: root
  key:
    path: "{{ ssl_certificate_directory }}/private/{{ ssl_certificate_basename }}.key"
    mode: "0600"
    owner: root
    group: root

# The permissions map var may reference user accounts that haven't been
# configured yet. Usernames include in the list below will be created as
# system accounts and groups prior to managing the permissions map.
ssl_certificate_create_users: []

# Dynamic handler support for restarting services in parent roles.
# Simply declare a list of strings, e.g. "restart apache2", and the
# associated handler will be called. The parent role must provide the handler.
ssl_certificate_dynamic_handlers: []
```

Example Playbook
----------------

Including an example of how to use your role (for instance, with variables passed in as parameters) is always nice for users too:

```
- hosts: logserver
  roles:
    - role: freedomofpress.generate-ssl-cert
      ssl_certificate_basename: logstash-client
      ssl_certificate_bit_length: 4096
```

License
-------

MIT
