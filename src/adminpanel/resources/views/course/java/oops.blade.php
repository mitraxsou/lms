@extends('layouts.app');

@section('title' ,  'Object Oriented Programming' );

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
				<h3>Object Oriented Programming Concepts</h3>
				</div>
				<div class="panel-body">
				<p>
At the center of Java is Object-Oriented Programming (OOP). The object oriented methodology is inseparable from Java, and all Java programs are, to at least some extent , object oriented. Because of OOPs importance of Java, it is useful to understand OOPs basic principles before you write even a simple Java program.</p><br/>
<p>
Java is Object Oriented Programming is a paradigm that provides many concepts such as inheritance, data binding, polymorphism etc.</p><br/>
<p>
<b>Simula</b> is considered as the first object-oriented programming language. The programming paradigm where everything is represented as an object, is known as truly object-oriented programming language.</p><br>
<p>
Object means a real word entity such as pen, chair, table etc. Object-Oriented Programming is a methodology or paradigm to design a program using classes and objects. It simplifies the software development and maintenance by providing some concepts:</p>
<ul style="list-style: none;">
<li>Inheritance</li>
<li>Polymorphism</li>
<li>Abstraction</li>
<li>Encapsulation</li>
</ul>
<br/><br/>

<h3>Inheritance</h3>
When one object acquires all the properties and behaviors of parent object i.e. known as inheritance. It provides code reusability. It is used to achieve runtime polymorphism.
<br/>

<h3>Polymorphism</h3>
When one task is performed by different ways i.e. known as polymorphism. For example: to convince the customer differently, to draw something e.g. shape or rectangle etc.
In java, we use method overloading and method overriding to achieve polymorphism.

<h3>Abstraction</h3>
Hiding internal details and showing functionality is known as abstraction. For example: phone call or ATM machine .we don't know the internal processing. 
In java, we use abstract class and interface to achieve abstraction.

<h3>Encapsulation</h3>
Binding (or wrapping) code and data together into a single unit is known as encapsulation. For example: capsule, it is wrapped with different medicines.
A java class is the example of encapsulation. Java bean is the fully encapsulated class because all the data members are private here.

				</div>
			</div>
		</div>
	</div>
</div>

@endsection