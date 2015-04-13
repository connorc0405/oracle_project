Python 2.7.4 (default, Apr  6 2013, 19:55:15) [MSC v.1500 64 bit (AMD64)] on win32
Type "copyright", "credits" or "license()" for more information.
>>> #! /usr/bin/env python
# -*- coding: utf-8 -*-
 
from __future__ import print_function
import sys
import subprocess
 
# Creates Python 2 and 3 compatible user input
# If this is Python 3, use input()
# and the proper module for the localhost.
if sys.version_info[:2] >= (3, 0):
    get_input = input
    command = "http.server"
 
# This is Python 2, use raw_input()
# and the proper module for the localhost.
else:
    get_input = raw_input
    command = "SimpleHTTPServer"
 
# Ensure the port number entered is an integer
valid = False
while not valid:
    try:
        portNumber = int(get_input("Enter your desired port: "))
        valid = True
    except ValueError:
        valid = False
 
print("Starting localhost\n")
try:
    # Relaunch the Python executable using the -m parameter
    subprocess.call([sys.executable, "-m",
                    command, str(portNumber)])
 
# Catch a KeyboardInterrupt to enable proper exiting
except KeyboardInterrupt:
    pass
>>> 
[DEBUG ON]
>>> 
[DEBUG OFF]
>>> 
