<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


# Invoice Collector
## About this project
This Laravel application is used to bulk download all the invoices found in my mailbox.

- The application connects to a mailbox using imap credentials
- Fetches the emails that contain an attachment from all the emails in the mailbox
- Downloads the attachments to a local folder
- Groups the invoices by the sender
