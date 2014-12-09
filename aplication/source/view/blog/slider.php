<div class="sidebar-module">
    <h4>Mas Vistos</h4>
    <ol class="list-unstyled">
        <?php foreach ($this->mas_vistos as $post) { ?>
            <li><a href="<?php echo BASEURL . 'blog/post/' . replace_spaces($post->titulo);?>"><?php echo $post->titulo; ?></a></li>
        <?php } ?>  
    </ol>
    <h4>Ultimos Posts</h4>
    <ol class="list-unstyled">
        <?php foreach ($this->ultimos as $post) { ?>
            <li><a href="<?php echo BASEURL . 'blog/post/' . replace_spaces($post->titulo);?>"><?php echo $post->titulo; ?></a></li>
        <?php } ?>        
    </ol>
    <h4>Archivo</h4>
    <ol class="list-unstyled">
        <?php foreach ($this->ultimos_meses as $post) { ?>
            <li><a href="<?php echo BASEURL . 'blog/fecha/' . $post->mes . '/' . $post->ano;?>"><?php echo  $post->mes . '-' . $post->ano . '('. $post->cant .')'; ?></a></li>
        <?php } ?>
    </ol>
    <h4>Tags</h4>
    <ol class="list-unstyled">
        <?php foreach ($this->tags as $tag) { ?>
            <li><a href="<?php echo BASEURL . 'blog/tag/' . replace_spaces($tag->nombre);?>"><?php echo  $tag->nombre; ?></a></li>
        <?php } ?>
    </ol>
</div>