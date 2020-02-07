#!/bin/bash

ansible-playbook 1_set-sudoer.yml -i $1 --ask-become-pass -b
