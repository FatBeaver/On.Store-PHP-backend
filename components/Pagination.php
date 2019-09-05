<?php 

class Pagination 
{   
    /**
     * Общее количество записей в БД
     * 
     */
    public $total;

    /**
     * Лимит записей для вывода на 1 страницу;
     * 
     */
    public $limit;

    /**
     * Текущая страница
     * 
     */
    public $currentPage;

    /**
     * Количество странниц ссылок
     * 
     */
    public $countPage;

    /**
     * Индекс записи с которой необходимо начинать выборку данных из БД;
     * 
     */
    public $offset;
    
    public $countNavLinks;

    public $URIindex;

    public function __construct($total, $limit, $currentPage, $index)
    {
        $this->total = $total;
        $this->limit = $limit;
        $this->currentPage = $currentPage;
        $this->countPage = ceil($total / $limit); 
        $this->offset = ($currentPage - 1) * $limit;
        $this->URIindex = $index;
    }

    public function getNavPageList()
    { ?>
    <ul class="pagination">

    <?php if ($this->currentPage != 1): ?>    
        <li class="page-item">
            <a href="/admin/user/page-<?= 1 ?>/" class="page-link" aria-label="Previous">
                <span aria-hidden="true">
                    <span class="lnr lnr-chevron-left"></span>
                </span>
            </a>
        </li>
    <?php endif; ?>   

    <?php if ($this->currentPage - 2 > 0): ?>
        <li class="page-item"><a href="/admin/user/page-<?= $this->currentPage - 2 ?>/" class="page-link">
        <?= $this->currentPage - 2 ?></a></li>
    <?php endif; ?>    
    <?php if ($this->currentPage - 1 > 0): ?>   
        <li class="page-item "><a href="/admin/user/page-<?= $this->currentPage - 1 ?>/" class="page-link">
        <?= $this->currentPage - 1 ?></a></li>
    <?php endif; ?>   

    <li class="page-item active"><a href="/admin/user/page-<?= $this->currentPage ?>/" class="page-link">
    <?= $this->currentPage; ?></a></li>
     
    <?php if ($this->currentPage + 1 < $this->countPage + 1): ?>   
        <li class="page-item"><a href="/admin/user/page-<?= $this->currentPage + 1?>/" class="page-link">
        <?= $this->currentPage + 1 ?></a></li>
    <?php endif; ?>  
    <?php if ($this->currentPage + 2 < $this->countPage + 1): ?> 
        <li class="page-item"><a href="/admin/user/page-<?= $this->currentPage + 2?>/" class="page-link">
        <?= $this->currentPage + 2 ?></a></li>
    <?php endif; ?>  

    <?php if ($this->currentPage != $this->countPage): ?>   
        <li class="page-item">
            <a href="/admin/user/page-<?= $this->countPage ?>/" class="page-link" aria-label="Next">
                <span aria-hidden="true">
                    <span class="lnr lnr-chevron-right"></span>
                </span>
            </a>
        </li>
    <?php endif; ?> 

    </ul>
   
<?php }
}