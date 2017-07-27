#!/bin/sh

testing=$(dirname $0)/vendor/bin/codecept
$testing build
$testing run
