<?php
namespace MetroPublisher\Api;

interface ResourceModelInterface
{
    /**
     * Returns a list of fields associated with this object.
     *
     * These fields describe the object, such as title, description,
     * date created/modified, etc.
     *
     * @return array
     */
    public static function getFieldNames();

    /**
     * Returns the object's default fields.
     *
     * When a collection of objects is queried from the MetroPublisher API,
     * it does not return all of an object's fields. The default fields that
     * are returned provided an overview of the object's contents.
     *
     * To obtain more detailed information about the object, a separate API call
     * must be made. These additional fields are called "meta fields".
     *
     * @see AbstractModel::getMetaFields()      To learn more about meta fields.
     * @see AbstractResourceCollection::all()  To learn how the default fields are fetched.
     *
     * @return array
     */
    public static function getDefaultFields();

    /**
     * Returns the object's meta fields.
     *
     * Meta fields provide additional information about an object, such as SEO
     * meta descriptions, HTML content of an article/book/review or other content
     * object, and other fields.
     *
     * These fields will not be returned when fetching groups of objects. A
     * separate request must be made to retrieve these fields.
     *
     * @see AbstractResourceCollection::find()  To learn how the meta fields are fetched.
     *
     * @return array
     */
    public static function getMetaFields();
}