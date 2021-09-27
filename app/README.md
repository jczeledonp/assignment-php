
# Lokalise PHP homework

Hi there!
I'm Juan Carlos Zeledón and I'm doing this **TMS lite** framework as a practical task for applying to Senior Backend (PHP) Engineer position at Lokalise.

**Please read my description approach to solve your tasks.**

## Description
I've created an API for a TMS enviroment following your requirements and adding a little extra options for easy of using and maintaining. I choose **Symfony** as my developing framework and MySQL for data source.

### Database
I created a MySQL database and it's included as [mysql.sql](https://github.com/jczeledonp/assignment-php/blob/master/app/mysql.sql "mysql.sql") inside `app` folder that includes with two users, one with read/write permission and other with readonly permissions.  Also includes all data for testing the TMS.

The database `tms` has tables for `Keys`,  `Languages`, `Translations` and `Users`, each one with sample data. 

The database `tms__test` it's available for testing purposes and it's only accessed in test mode or by *phpUnit*, for example.

I also created a [workspace on Postman](https://app.getpostman.com/join-team?invite_code=40dd12943be4a837293e90de972b712a&ws=14461341-a806-43b8-b881-2953bc6779bb) with possible cases to test the API, in case you want to access it.

### Security
`Tokens` must be sent to API in order to receive access, if not the TMS will throw an authentication error.  Tokens must be passed as HTTP headers with `X-API-TOKEN` as key and one of the following values:

|Token| Permissions |
|--|--|
| f38adcb5a9f6310cbac75bcab7f7844c |Read/Write  |
| 49dd891aaffc81b8c716b785c350fa83 |Read  |

The API read the `Token` and check it against the database to get user permissions, so users can't send any token they want.

`Permissions` are checked before any write operation (create/update/delete) and therefore users will be allowed or not to fulfill the request. Any not authorized operation will throw a message with `403 error` back to user.

All operations must be done with the proper HTTP request, if not API will send a `400 error` message. Once the token it's confirmed, the API will allow to users read and/or write according their permissions.  


### Architecture
Project was divided in multiple task, one of each performed by an independent class whenever it's possible. The structure is the following:

 - **Controller:** receives all the API requests and delivery it to the proper Service to solve it and send an answer back to user.
 - **Entity:** defines our entities structure and relates it to Repository
 - **Form:** used to provide validation against user request and prevent to receive any malformed petition.
 - **Repository:** create relations between our Entity and our database. All database related operations were defined here.
 - **Security:** provides a security layer on top the TMS and answer to any permissions request made by Controller or Services
 - **Service:** act as a solution provider for all interactions between Controller, Entity, Form and Repository.


### API Functionality
- API token authentication on all levels
- `Languages`
	- **List**: `GET api/languages` list all available language with Id, Name, ISO name and RTL information.
- `Keys`: 
  - **List**: `GET /api/keys` list all Keys with their respective Translations for each Language with all detailed information.
  - **Retrieve**: `GET /api/keys/{KeyId}` get information about a desired Key with matching *KeyId* .
  - **Create**: `POST /api/keys/create` create a new Key or warn to user there is a previous Key with same name and aborts operation.
  - **Rename**: `PUT /api/keys/{KeyId}`change text of Key with matching *KeyId* or warn to user there is a previous Key with same name and aborts operation.
  - **Delete**: `DELETE /api/keys/{KeyId}` delete requested Key with matching *KeyId* and all related Translations.
- `Translations`: 
  - **List**: `GET /api/translations` list all Translations with their respective with all detailed information about Key and Language.  Also provide information about who/when was created/updated.
  - **Retrieve**: `GET /api/translations/{TranslationId}` get information about a desired Translation with matching *TranslationId* .
  - **Create**: `POST /api/translations/create/{KeyId}/{IsoCode}` create a new Translation in *IsoCode* language for desired Key with matching *KeyId*or warn to user there is a previous Translation for same Key/Language pair and aborts operation.
   - **Delete**: `DELETE /api/translations/{TranslationId}` delete requested Translation with matching *TranslationId* without affecting Key nor its translations.
- Manage `Key` `Translations`:
  - **Update**: `PUT /translations/{KeyId}/{IsoCode}`change text for a current Translation of a Key with matching *KeyId* or warn to user there is a no previous Translation with same Key/Language pair and aborts operation.

- Export`Key` `Translations`:
	- **Files**: `POST api/files` create a `zip` archive with all  `Keys` and their `Translations` in `.json` and `.yml` . User receives one download link for each version. The `zip` files have the following structure inside:
    - `.json` export have one file per language, each one named as `[language-iso].json` with the following format:
        ```
        {
            <key.name>: <translation.value>,
            ...
        }
    - `.yaml` export contain all languages in a single `translations.yaml` file with the following format:
        ```
        <language.iso>:
            <key.name>: <translation.value>
            ...
        <language2.iso>:
            <key.name>: <translation.value>
            ...

### Notes
- Project was created in **Symfony** following proposed environment
- There are some Test cases to verify unique Key names under `/tests`


**********************
Thanks for the opportunity to participate in this project.

Best regards,

*Juan Carlos Zeledón Paniagua*
