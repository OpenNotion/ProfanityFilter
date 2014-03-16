#ProfanityFilter

The OpenNotion profanity filter library used to replace profanities within ideas, comments and other pieces of user editable text.

##What?

This library searches for certain strings within blocks of text and replaces them with other defined blocks of text.

This library is made to be used with Laravel, but can easily be used with other frameworks or standard PHP so long as you implement the `OpenNotion\ProfanityFilter\Repository\ProfanityRepositoryInterface` contract for fetching profanities and their replacements.

##Who?

This library is part of the [OpenNotion](http://opennotion.net/) project.  OpenNotion is an stand-alone open source idea collaboration software. It allows people to give feedback, collaborate on ideas and helps you see just what your users want.

##Planned Features

Right now this library does the bare minimum to replace search strings. However, the below features are planned:

- Profanity replacement priorities - modify the priorities for replacing profanities so that profanities are replaced in a defined order.
- Intelligent replacing - currently this library will replace all occurrences of words it finds and only words it finds. This causes problems when filtering words such as "ass" that would result in replacements such as "***istant". Only exact matches are currently filtered too.
