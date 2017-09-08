<?php
/**
 * This file is part of phpDocumentor.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright 2010-2015 Mike van Riel<mike@phpdoc.org>
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      http://phpdoc.org
 */

namespace phpDocumentor\Reflection\DocBlock\Tags;

use phpDocumentor\Reflection\DocBlock\DescriptionFactory;
<<<<<<< HEAD
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Fqsen as FqsenRef;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Reference;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Url;
=======
>>>>>>> release/v2
use phpDocumentor\Reflection\Fqsen;
use phpDocumentor\Reflection\FqsenResolver;
use phpDocumentor\Reflection\Types\Context as TypeContext;
use phpDocumentor\Reflection\DocBlock\Description;
use Webmozart\Assert\Assert;

/**
 * Reflection class for an {@}see tag in a Docblock.
 */
class See extends BaseTag implements Factory\StaticMethod
{
    protected $name = 'see';

<<<<<<< HEAD
    /** @var Reference */
=======
    /** @var Fqsen */
>>>>>>> release/v2
    protected $refers = null;

    /**
     * Initializes this tag.
     *
<<<<<<< HEAD
     * @param Reference $refers
     * @param Description $description
     */
    public function __construct(Reference $refers, Description $description = null)
=======
     * @param Fqsen $refers
     * @param Description $description
     */
    public function __construct(Fqsen $refers, Description $description = null)
>>>>>>> release/v2
    {
        $this->refers = $refers;
        $this->description = $description;
    }

    /**
     * {@inheritdoc}
     */
    public static function create(
        $body,
        FqsenResolver $resolver = null,
        DescriptionFactory $descriptionFactory = null,
        TypeContext $context = null
    ) {
        Assert::string($body);
        Assert::allNotNull([$resolver, $descriptionFactory]);

        $parts       = preg_split('/\s+/Su', $body, 2);
        $description = isset($parts[1]) ? $descriptionFactory->create($parts[1], $context) : null;

<<<<<<< HEAD
        // https://tools.ietf.org/html/rfc2396#section-3
        if (preg_match('/\w:\/\/\w/i', $parts[0])) {
            return new static(new Url($parts[0]), $description);
        }

        return new static(new FqsenRef($resolver->resolve($parts[0], $context)), $description);
    }

    /**
     * Returns the ref of this tag.
     *
     * @return Reference
=======
        return new static($resolver->resolve($parts[0], $context), $description);
    }

    /**
     * Returns the structural element this tag refers to.
     *
     * @return Fqsen
>>>>>>> release/v2
     */
    public function getReference()
    {
        return $this->refers;
    }

    /**
     * Returns a string representation of this tag.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->refers . ($this->description ? ' ' . $this->description->render() : '');
    }
}
