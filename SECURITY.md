# GitHub Security Policy

## Reporting a Vulnerability
To report a security vulnerability, please follow these steps:

1. **Do not create a public GitHub issue.** Instead, email us directly at [admin@gratitude.thoughtcultivation.com](mailto:admin@gratitude.thoughtcultivation.com).
2. Provide a detailed description of the vulnerability, including:
   - Steps to reproduce the issue.
   - Affected components/files.
   - Potential impact of the vulnerability.
   - Any suggestions for a fix, if applicable.
3. I will acknowledge your report and work with you to investigate and address the issue.

## Security Best Practices
This repository implements the following measures to enhance security:

- **CSRF Protection:** All forms are protected using CSRF tokens to prevent cross-site request forgery attacks.
- **Input Sanitization:** User inputs are sanitized to prevent SQL injection and cross-site scripting (XSS).
- **Prepared SQL Statements:** All database interactions use parameterized queries to mitigate SQL injection risks.
- **Access Control:** The application includes public/private toggles for shared letters to limit unauthorized access.
- **Error Logging:** Errors are logged securely without exposing sensitive data.

## Responsible Disclosure
I believe in responsible disclosure. Please allow me a reasonable time frame to address and release a fix before disclosing vulnerabilities to the public.

## Questions or Concerns
For general questions or clarifications regarding the security policy, open a GitHub issue or contact us directly at [admin@gratitude.thoughtcultivation.com](mailto:admin@gratitude.thoughtcultivation.com).
