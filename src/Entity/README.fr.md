# List of entities with some attributes's description
_Continuer en Francais_ | _[Read in English](README.md)_

## User
Elle represente l'utilisateur sur le site web.
 - **username** [string] : Identifiant unique pour chaque utilisateur
 - firstname [string]
 - lastname [string]
 - email [string]
 - phone [integer]
 - country [string]
 - region [string]
 - city [string]
 - _createdAt_ [datetime_immutable]: date de creation
 - bornOn [date_immutable]
 - **role** [string] : Le rôle de l’utilisateur, les rôles disponibles sont: **ROLE_USER**, **ROLE_CUSTOMER**, **ROLE_BARBER**, **ROLE_ADMIN**, **ROLE_SUPER_ADMIN**
 - profilePhoto [image](#image)
 - salons _array of_ [salon](#salon) : La liste des salons appartenant à l’utilisateur. Cet utilisateur doit avoir le rôle **ROLE_BARBER**
 - managedSalon [salon](#salon) : Un utilisateur peut gérer le salon d’un autre
 - workingSalon [salon](#salon) : Le salon dans lequel l'utilisateur travaille (doit avoir **ROLE_BARBER**)
 - subscriptionPlan [subscription_plan](#subscription-plan)
 - subscriptionPaymentDate [date_immutable] : Le jour où l’utilisateur a souscrit à un plan
 - transfersAccounts _array of_ [transfer_account](#transfer-account) : Liste des comptes de transfert d'un utilsateur

## Salon
Représentation d’un salon de coiffure.
 - name [string]
 - slogan [string]
 - email [string]
 - phone [integer]
 - country [string]
 - region [string]
 - city [string]
 - _createdAt_ [date_immutable]
 - catalogue [catalogue](#catalogue)
 - owner [user](#user) : Le propriétaire du Salon, par défaut le créateur
 - managers _array of_ [user](#user) : Liste des utilisateurs (avec le rôle de **ROLE_BARBER**) qui gèrent le Salon avec le propriétaire
 - employees _array of_ [user](#user)
 - transfersAccounts _array of_ [transfer_account](#transfer-account) : Liste des comptes de transfert du salon

## Transfer

## Article

## Catalogue

## Event

## Subscription Plan

## SubEntities

### Image

### Transfer Account