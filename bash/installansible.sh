#!/bin/bash

if [ -f /etc/debian_version ] || [ grep -qi ubuntu /etc/lsb-release ] || grep -qi ubuntu /etc/os-release; then
  apt-get update
  apt-get install -y python-pip python-yaml python-jinja2 python-httplib2 python-paramiko python-pkg-resources
    [ -n "$( apt-cache search python-keyczar )" ] && apt-get install -y  python-keyczar
    if ! apt-get install -y git ; then
      apt-get install -y git-core
    fi
    # If python-pip install failed and setuptools exists, try that
    if [ -z "$(which pip)" -a -z "$(which easy_install)" ]; then
      apt-get -y install python-setuptools
      easy_install pip
    elif [ -z "$(which pip)" -a -n "$(which easy_install)" ]; then
      easy_install pip
    fi
    # If python-keyczar apt package does not exist, use pip
    [ -z "$( apt-cache search python-keyczar )" ] && sudo pip install python-keyczar

    # Install passlib for encrypt
    apt-get install -y build-essential
    apt-get install -y python-all-dev python-mysqldb sshpass && pip install pyrax pysphere boto passlib dnspython

    # Install Ansible module dependencies
    apt-get install -y bzip2 file findutils git gzip mercurial procps subversion sudo tar debianutils unzip xz-utils zip python-selinux
    pip install ansible
else
  # OSX likely
  sudo easy_install pip
  sudo CFLAGS=-Qunused-arguments CPPFLAGS=-Qunused-arguments pip install ansible
fi
