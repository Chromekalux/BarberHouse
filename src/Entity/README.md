# List of entities with some attributes's description
_Continue in English_ | _[Lire en Francais](README.fr.md)_

## User
It represents the User on the website.
 - **username** [string] : An unique identifier for each user
 - firstname [string]
 - lastname [string]
 - email [string]
 - phone [integer]
 - country [string]
 - region [string]
 - city [string]
 - _createdAt_ [datetime_immutable]: CURRENT TIMESTAMP
 - bornOn [date_immutable]
 - **role** [string] : The role of the user, the availables roles are: **ROLE_USER**, **ROLE_CUSTOMER**, **ROLE_BARBER**, **ROLE_ADMIN**
 - profilePhoto [image](#image)
 - agenda [agenda](#agenda)
 - posts _array of_[post](#post) : The list of posts made by the user
 - comments _array of_[comment](#comment)
 - salons _array of_ [salon](#salon) : The list of salons owned by the user. This user should have the role **ROLE_BARBER**
 - managedSalon [salon](#salon) : A user can managed the salon of another one
 - workingSalon [salon](#salon) : A user can work in a salon
 - subscriptionPlan [subscription_plan](#subscription-plan)
 - subscriptionPaymentDate [date_immutable] : The day when the user has subscribed to a plan
 - transfersAccounts _array of_ [transfer_account](#transfer-account) : List of transfer accounts of the user

## Salon
Representing a Barber shop, hairdressing salon.
 - name [string]
 - slogan [string]
 - email [string]
 - phone [integer]
 - country [string]
 - region [string]
 - city [string]
 - _createdAt_ [date_immutable]: CURRENT TIMESTAMP
 - catalogue [catalogue](#catalogue)
 - owner [user](#user) : The Salon owner by default the creator
 - managers _array of_ [user](#user) : List of user(with **ROLE_BARBER**'s role) that are managing the Salon with the owner
 - employees _array of_ [user](#user)
 - agenda [agenda](#agenda)
 - posts _array of_[post](#post) : The list of posts made by the salon
 - transfersAccounts _array of_ [transfer_account](#transfer-account) : List of transfer accounts of the salon

## Transfer

### Transfer Account

## Article

## Catalogue

## Subscription Plan

## Agenda

## Event

## Post

### Comment

### Image
