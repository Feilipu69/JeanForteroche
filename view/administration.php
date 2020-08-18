<h3>Episodes</h3>
<a href="">Ajouter un épisode</a>
<table>
	<tr>
		<th>Chapitre</th>
		<th>Titre</th>
		<th>Créé le</th>
		<th>Modifié le</th>
		<th>Action</th>
	</tr>
<?php
foreach ($episodes as $episode) {
	?>
		<tr>
			<td><?=$episode->getChapter(); ?></td>
			<td><a href="episode?chapter=<?=$episode->getChapter(); ?>"><?=$episode->getTitle(); ?></a></td>
			<td><?= $episode->getCreationDate(); ?></td>
			<td><?= $episode->getUpdateDate(); ?></td>
			<td><a href="">Modifier</a><a href="">Supprimer</a></td>
		</tr>
	<?php
}
?>
</table>
<h3>Commentaires signalés</h3>
<table>
	<tr>
		<th>Auteur</th>
		<th>Chapitre</th>
		<th>Commentaire</th>
		<th>Signalements</th>
		<th>Action</th>
	</tr>
	<?php
	foreach ($rudeComments as $rudeComment) {
		?>
		<tr>
			<td><?= $rudeComment->getAuthor(); ?></td>
			<td><?= $rudeComment->getEpisodeId(); ?></td>
			<td><?= $rudeComment->getComment(); ?></td>
			<td><?= $rudeComment->getRudeComment(); ?></td>
			<td>Supprimer</td>
		<?php
	}
	?>
</table>
