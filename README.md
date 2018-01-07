# WordPress SUV

## Description

This package is a scaffold for implementing the **SUV** architecture.

**SUV** is a software architecture for building WordPress apps, proposed and developed by [*GrottoPress*](https://www.grottopress.com).

**SUV** is short for *Setups-Utilities-Views*, which... well... organises code into three groups: Setups, Utilities, and Views.

It emphasises an object oriented approach to writing WordPress plugins and themes, and provides for a cleaner, more organised code base.

**Setups**: Includes all classes that modify the page life cycle in any way, by means of action and filter hooks.

**Utilities**: Utilities are classes that help the setups achieve their goal.

**Views**: Views are templates and partials to be loaded by WordPress.

## Documentation

Link to be posted soon.

## Usage

From the root of your theme or plugin, run:

`composer require grottopress/wordpress-suv`

Go ahead and use the provided (abstract) classes in your theme or plugin.
