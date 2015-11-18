
<div class='vra-data'>
<?php
    $nameBase = "vra-element[{$omekaElement->id}]";
    $ignoreAttributes =  get_option('vra-core-ignore-attributes');
?>
<?php if(! $ignoreAttributes): ?>
<p>Display Element Attributes</p>

    <?php echo $this->partial('element-attribute-form.php', 
            array(
                 'attributeNames'   => $globalAttributes,
                 'attributeObjects' => $attributeObjects,
                 'nameBase'         => $nameBase . "[display]"
                 )
            );
    ?>

<?php endif; ?>

<p><?php echo $omekaElement->name; ?> Elements</p>
    <div class='vra-element'>
        <textarea name='<?php echo $nameBase; ?>[newElements][0][content]' value=''></textarea>
        <input type='hidden' name='<?php echo $nameBase; ?>[newElements][0][name]' value='<?php echo $omekaElement->name; ?>'></input>
        
        <?php if(! $ignoreAttributes): ?>
            <?php echo $this->partial('element-attribute-form.php', 
                    array(
                         'attributeNames'   => $attributeNames,
                         'attributeObjects' => $attributeObjects,
                         //kind of a cheat. put true at the front to produce a new set of attributes for new element
                         'vraElementObjects' => array(true),
                         'nameBase'         => $nameBase . "[newElements][0]"
                         )
                    );
            ?>
        <?php endif; ?>
    </div>
    
<?php foreach($vraElementObjects as $vraElementObject): ?>
    <div class='vra-element'>
        <textarea name='<?php echo $nameBase; ?>[<?php echo $vraElementObject->id; ?>][content]' value='<?php echo $vraElementObject->content; ?>'><?php echo $vraElementObject->content; ?></textarea>
        <?php if(! $ignoreAttributes): ?>
            <?php echo $this->partial('element-attribute-form.php', 
                    array(
                         'attributeNames'   => $attributeNames,
                         'attributeObjects' => $attributeObjects,
                         //kind of a cheat. put true at the front to produce a new set of attributes for new element
                         'vraElementObjects' => $vraElementObjects,
                         'nameBase'         => $nameBase . "[{$vraElementObject->id}]"
                         )
                    );
            ?>
        <?php endif; ?>
    </div>

<?php endforeach;?>
</div>