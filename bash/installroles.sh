#!/bin/bash
export ROLES_PATH=deploy/roles

roles=(
  "geerlingguy.apache"
  "thefinn93.letsencrypt"
  "wtanaka.monit"
)

for role in "${roles[@]}"
do
  ansible-galaxy install "$role" --roles-path=$ROLES_PATH
done
