<?php if($pages > 1) : ?>
    <nav aria-label="Page navigation" class="page-navigation">
        <ul class="pagination">
            <?php if($page != 1) : ?>
                <li>
                    <a href="/admin/list?page=<?= $page-1 ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php endif; ?>


            <?php for($i = 1; $i<= $pages; $i++):
                if($page != $i):
                    ?>
                    <li>
                        <a href="/admin/list?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php else :?>
                    <li class='active'><?= $i ?></li>
                <?php endif; endfor; ?>

            <?php if($page != $pages): ?>
                <li>
                    <a href="/admin/list?page=<?= $page+1 ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
<? endif; ?>