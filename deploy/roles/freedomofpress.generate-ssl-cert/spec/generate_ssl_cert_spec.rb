require 'spec_helper'

describe package('openssl') do
  it { should be_installed }
end

describe file('/etc/pki/tls/certs') do
  it { should exist }
  it { should be_directory }
  its('owner') { should eq 'root' }
  its('group') { should eq 'root' }
  its('mode') { should eq '755' }
end

describe file('/etc/pki/tls/private') do
  it { should exist }
  it { should be_directory }
  its('owner') { should eq 'root' }
  its('group') { should eq 'root' }
  its('mode') { should eq '700' }
end

cert_path = '/etc/pki/tls/certs/logstash-client.crt'
key_path = '/etc/pki/tls/private/logstash-client.key'

describe x509_certificate(cert_path) do
  it { should be_certificate }
  it { should be_valid }
  its(:subject) { should eq '/C=AU/ST=Some-State/O=Internet Widgits Pty Ltd' }
  its(:keylength) { should be >= 2048 }
  its(:validity_in_days) { should_not be < 100 }
  its(:validity_in_days) { should be >= 100 }
  # Ostensibly a superfluous test, but if using custom values, only one test
  # will fail, and the others (e.g. '>= 100') will still pass, improving the
  # quality of the error output.
  its(:validity_in_days) { should be >= 3000 }
end

describe file(cert_path) do
  its('owner') { should eq 'root' }
  its('group') { should eq 'root' }
  its('mode') { should eq '644' }
  it { should be_readable.by('others') }
  it { should be_readable.by_user('nobody') }
end

describe x509_private_key(key_path) do
  it { should be_valid }
  it { should_not be_encrypted }
  it { should have_matching_certificate(cert_path) }
end

describe file(key_path) do
  its('owner') { should eq 'root' }
  its('group') { should eq 'root' }
  its('mode') { should eq '600' }
  it { should_not be_readable.by_user('nobody') }
end
