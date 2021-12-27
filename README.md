[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]
[![MIT License][license-shield]][license-url]

[comment]: <> ([![LinkedIn][linkedin-shield]][linkedin-url])



<!-- PROJECT LOGO -->
<br />
<p align="center">

  <h1 align="center">lumen-auth</h1>

  <p align="center">
      A library with simple JWT authentication.
      <br />
      <!--<a href="https://github.com/sofiakb/lumen-auth"><strong>Explore the docs »</strong></a>-->
      <br />
      <br />
      <a href="https://github.com/sofiakb/lumen-auth/issues">Report Bug</a>
      ·
      <a href="https://github.com/sofiakb/lumen-auth/issues">Request Feature</a>
  </p>

</p>



<!-- TABLE OF CONTENTS -->
<details open="open">
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About the library</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#acknowledgements">Acknowledgements</a></li>
  </ol>
</details>



<!-- ABOUT THE PROJECT -->

## About The Library

The library allows to detect os system in PHP project.

### Built With

This section should list any major frameworks that you built your project using. Leave any add-ons/plugins for the
acknowledgements section. Here are a few examples.

* [PHP](https://php.net)

<!-- GETTING STARTED -->

### Prerequisites

- php >= 7.4
- laravel/laravel >= 8 ou laravel/lumen-framework >= 8

### Installation

```shell
composer require sofiakb/lumen-auth
```

<!-- USAGE EXAMPLES -->

## Usage

```php
// Fichier bootstrap/app.php
$app->register(Sofiakb\Lumen\Auth\Providers\AuthServiceProvider::class);

// Fichier routes/api.php
\Sofiakb\Lumen\Auth\Auth::routes();
```

Ensuite, lancer la commande suivante

```shell
php artisan jwt:secret
```

### Commands list

```shell
php artisan auth:activate # Activate auth account by username/email.
php artisan auth:clear-resets # Flush expired password reset tokens.
php artisan auth:config # Copy auth config file.
php artisan auth:deactivate # Deactivate auth account by username/email.
php artisan auth:table # Create migration for users & connections table.
php artisan auth:user:create # Create new user and save it into database.
```

<!-- ROADMAP -->

## Roadmap

See the [open issues](https://github.com/sofiakb/lumen-auth/issues) for a list of proposed features (and known issues).


<!-- LICENSE -->

## License

Distributed under the MIT License. See `LICENSE` for more information.


<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->

[contributors-shield]: https://img.shields.io/github/contributors/sofiakb/lumen-auth.svg?style=for-the-badge

[contributors-url]: https://github.com/sofiakb/lumen-auth/graphs/contributors

[forks-shield]: https://img.shields.io/github/forks/sofiakb/lumen-auth.svg?style=for-the-badge

[forks-url]: https://github.com/sofiakb/lumen-auth/network/members

[stars-shield]: https://img.shields.io/github/stars/sofiakb/lumen-auth.svg?style=for-the-badge

[stars-url]: https://github.com/sofiakb/lumen-auth/stargazers

[issues-shield]: https://img.shields.io/github/issues/sofiakb/lumen-auth.svg?style=for-the-badge

[issues-url]: https://github.com/sofiakb/lumen-auth/issues

[license-shield]: https://img.shields.io/github/license/sofiakb/lumen-auth.svg?style=for-the-badge

[license-url]: https://github.com/sofiakb/lumen-auth/blob/main/LICENSE

[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555

[linkedin-url]: https://www.linkedin.com/in/sofiane-akbly/