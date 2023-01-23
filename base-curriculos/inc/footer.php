</main>
<!-- /container -->

<hr>
	<footer class="container">
		<p>&copy;2017 - Grupo Empresa <?php if (!empty($_SESSION['nivel_acesso']) == true and $_SESSION['nivel_acesso'] == 2) echo ' - ' . VERSION; ?></p>
	</footer>
	</body>
</html>